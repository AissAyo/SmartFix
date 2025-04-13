<?php
namespace App\Service\Auth;

use App\Entity\Client;
use App\Service\CRUD\ClientService;
use App\Service\Verification\WhatsAppVerificationCodeSender;

class AuthClientService
{
private ClientService $clientService;
private WhatsAppVerificationCodeSender $codeSender;

public function __construct(ClientService $clientService, WhatsAppVerificationCodeSender $codeSender)
{
$this->clientService = $clientService;
$this->codeSender = $codeSender;
}

public function registerClient(Client $client): void
{
$this->clientService->createClient($client);
}

public function sendVerificationCode(string $phone): void
{
$this->codeSender->sendCode($phone);
}

public function verifyCode(string $phone, string $code): bool
{
return $this->codeSender->verifyCode($phone, $code);
}
}
