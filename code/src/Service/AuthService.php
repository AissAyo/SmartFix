<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\ClientRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Client;
use App\Entity\Garagiste;
use App\Entity\mechanic;
use App\Entity\ServiceClient;


class AuthService
{
    private ClientRepository $ClientRepository;
    private UserPasswordHasherInterface $passwordHasher;
    private RequestStack $requestStack;

    public function __construct(
        ClientRepository $ClientRepository,
        UserPasswordHasherInterface $passwordHasher,
        RequestStack $requestStack
    ) {

        $this->ClientRepository = $ClientRepository;
        $this->passwordHasher = $passwordHasher;
        $this->requestStack = $requestStack;
    }

    public function authenticate(string $email, string $password): ?User
    {
        $user = $this->ClientRepository->findUserByEmail($email);

        if (!$user || !$this->passwordHasher->isPasswordValid($user, $password)) {
            return null; // Retourne null si l'authentification échoue
        }

        return $user;
    }

    public function loginUser(Client $user): void
    {
        $session = $this->requestStack->getSession();

        $session->set('user', [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'type' => $user instanceof Client ? 'client' : ($user instanceof ServiceClient ? 'ServiceClient' : 'other')
        ]);
    }

    public function logoutUser(): void
    {
        $this->requestStack->getSession()->remove('user');
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
