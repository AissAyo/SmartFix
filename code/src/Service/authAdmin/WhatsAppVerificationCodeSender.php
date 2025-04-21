<?php
namespace App\Service\authAdmin;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Twilio\Rest\Client as TwilioClient;

class WhatsAppVerificationCodeSender
{
private TwilioClient $twilio;
private CacheItemPoolInterface $cache;
private LoggerInterface $logger;
private string $twilioFromNumber;
private string $twilioContentSid;

public function __construct(
TwilioClient $twilio,
CacheItemPoolInterface $cache,
LoggerInterface $logger,
string $twilioFromNumber,
string $twilioContentSid
) {
$this->twilio = $twilio;
$this->cache = $cache;
$this->logger = $logger;
$this->twilioFromNumber = $twilioFromNumber;
$this->twilioContentSid = $twilioContentSid;
}

public function sendVerificationCode(string $phoneNumber): bool
{
$formattedNumber = $this->formatPhoneNumber($phoneNumber);
$code = str_pad((string) rand(0, 999999), 6, '0', STR_PAD_LEFT);

try {
$params = [
'from' => $this->twilioFromNumber,
];

if ($this->twilioContentSid) {
$params['contentSid'] = $this->twilioContentSid;
$params['contentVariables'] = json_encode(['1' => $code]);
} else {
$params['body'] = "Your verification code is: $code";
}

$this->twilio->messages->create($formattedNumber, $params);

$cacheItem = $this->cache->getItem('verification_code_' . md5($formattedNumber));
$cacheItem->set($code);
$cacheItem->expiresAfter(300);
$this->cache->save($cacheItem);

return true;
} catch (\Exception $e) {
$this->logger->error('Failed to send verification code: ' . $e->getMessage());
return false;
}
}

public function formatPhoneNumber(string $phoneNumber): string
{
$phoneNumber = preg_replace('/\D/', '', $phoneNumber);

if (empty($phoneNumber)) {
throw new \InvalidArgumentException('Phone number cannot be empty');
}

if (str_starts_with($phoneNumber, '0')) {
$phoneNumber = '212' . substr($phoneNumber, 1);
}

if (!str_starts_with($phoneNumber, '212') && !str_starts_with($phoneNumber, '+')) {
$phoneNumber = '+' . $phoneNumber;
} elseif (!str_starts_with($phoneNumber, '+')) {
$phoneNumber = '+' . $phoneNumber;
}

return 'whatsapp:' . $phoneNumber;
}
    public function verifyCode(string $phoneNumber, string $inputCode): bool
    {
        $formattedNumber = $this->formatPhoneNumber($phoneNumber);
        $cacheKey = 'verification_code_' . md5($formattedNumber);
        $cacheItem = $this->cache->getItem($cacheKey);

        if (!$cacheItem->isHit()) {
            return false; // Code not found or expired
        }

        $cachedCode = $cacheItem->get();

        if ($cachedCode === $inputCode) {
            // Optionally delete the code after successful verification
            $this->cache->deleteItem($cacheKey);
            return true;
        }

        return false;
    }

}
