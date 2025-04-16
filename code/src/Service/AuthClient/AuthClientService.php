<?php

namespace App\Service\AuthClient;

use App\Entity\Client;
use App\Service\CRUD\ClientService;
use Psr\Log\LoggerInterface;

class AuthClientService
{
    private ClientService $clientService;
    private WhatsAppVerificationCodeSender $codeSender;
    private LoggerInterface $logger;

    public function __construct(
        ClientService $clientService,
        WhatsAppVerificationCodeSender $codeSender,
        LoggerInterface $logger
    ) {
        $this->clientService = $clientService;
        $this->codeSender = $codeSender;
        $this->logger = $logger;
    }

    public function registerClient(Client $client): bool
    {
        try {
            if ($this->clientService->existsByEmail($client->getEmail())) {
                $this->logger->warning('Registration attempt with existing email', [
                    'email' => $client->getEmail()
                ]);
                return false;
            }

            if ($this->clientService->phoneExists($client->getPhone())) {
                $this->logger->warning('Registration attempt with existing phone', [
                    'phone' => $client->getPhone()
                ]);
                return false;
            }

            $this->clientService->saveClient($client);

            return $this->sendVerificationCode($client->getPhone());

        } catch (\Throwable $e) {
            $this->logger->error('Client registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    public function sendVerificationCode(string $phone): bool
    {
        try {
            return $this->codeSender->sendVerificationCode($phone);
        } catch (\Throwable $e) {
            $this->logger->error('Failed to send verification code', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function verifyCode(string $phone, string $code): bool
    {
        try {
            return $this->codeSender->verifyCode($phone, $code);
        } catch (\Throwable $e) {
            $this->logger->error('Verification failed', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function isLoggedIn(): bool
    {
        return $this->clientService->getCurrentClient() !== null;
    }
}
