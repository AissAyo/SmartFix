<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class UserSessionManager
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
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
