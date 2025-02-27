<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Client;
use App\Entity\Garagiste;
use App\Entity\mechanic;
use App\Entity\ServiceClient;
class UserSessionManager
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    public function loginUser($user): void
    {
        if (!$user instanceof Client && !$user instanceof ServiceClient) {
            throw new \InvalidArgumentException('Type d’utilisateur non reconnu.');
        }

        $userType = $user instanceof Client ? 'client' : 'ServiceClient';

        // Accédez à la session à travers RequestStack
        $session = $this->requestStack->getSession();

        // Stocker les informations de l'utilisateur dans la session
        $session->set('user', [
            'email' => $user->getEmail(),
            'type' => $userType,
        ]);
    }

    public function isLoggedIn(): bool
    {
        $session = $this->requestStack->getSession();
        return $session && $session->has('user');
    }

    public function getUser(): ?array
    {
        $session = $this->requestStack->getSession();
        return $session ? $session->get('user') : null;
    }

    public function getUserType(): ?string
    {
        $user = $this->getUser();
        return $user['type'] ?? null;
    }

    public function isAdmin(): bool
    {
        return $this->getUserType() === 'admin';
    }

    public function isClientService(): bool
    {
        return $this->getUserType() === 'clientService';
    }

    public function isGaragiste(): bool
    {
        return $this->getUserType() === 'garagiste';
    }

    public function isClient(): bool
    {
        return $this->getUserType() === 'client';
    }
}
