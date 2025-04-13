<?php

namespace App\Service\Verification;

use Twilio\Rest\Client;
use Psr\Cache\CacheItemPoolInterface;

class WhatsAppVerificationCodeSender
{
    private Client $twilio;
    private CacheItemPoolInterface $cache;
    private string $twilioFromNumber;

    public function __construct(Client $twilio, CacheItemPoolInterface $cache, string $twilioFromNumber)
    {
        $this->twilio = $twilio;
        $this->cache = $cache;
        $this->twilioFromNumber = $twilioFromNumber;
    }

    public function sendVerificationCode(string $phoneNumber): bool
    {
        // Generate a 6-digit verification code
        $verificationCode = random_int(100000, 999999);

        // Store the verification code in cache with 10-minute expiration
        $cacheItem = $this->cache->getItem('whatsapp_verification_' . $phoneNumber);
        $cacheItem->set($verificationCode);
        $cacheItem->expiresAfter(600);  // 10 minutes
        $this->cache->save($cacheItem);

        // Send the verification code via WhatsApp to the phone number
        try {
            $message = $this->twilio->messages->create(
                'whatsapp:' . $phoneNumber,  // The recipient phone number (WhatsApp format)
                [
                    'from' => 'whatsapp:' . $this->twilioFromNumber,  // Sender's number (Twilio sandbox number)
                    'body' => "Your verification code is: $verificationCode"
                ]
            );

            return $message->sid ? true : false;
        } catch (\Exception $e) {
            // Handle any errors in sending the message
            return false;
        }
    }

    public function verifyCode(string $phoneNumber, string $code): bool
    {
        // Check if the code is stored in cache
        $cacheItem = $this->cache->getItem('whatsapp_verification_' . $phoneNumber);
        if ($cacheItem->isHit()) {
            // Retrieve the stored code from cache
            $storedCode = $cacheItem->get();

            // Compare the codes
            if ((string) $storedCode === $code) {
                // Code is correct, return true
                return true;
            }
        }

        // If code is incorrect or expired
        return false;
    }
}
