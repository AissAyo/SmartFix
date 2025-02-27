<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Client;
use App\Entity\ServiceClient;
use App\Entity\Seller;
use App\Entity\Mechanic;
use App\Entity\CarRentalService;
use App\Entity\Admin;  // Ajout de l'Admin

class AuthService
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $passwordHasher;
    private RequestStack $requestStack;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        RequestStack $requestStack
    ) {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->requestStack = $requestStack;
    }

    public function authenticate(string $email, string $password): ?User
    {
        $user = $this->userRepository->findUserByEmail($email);

        if (!$user || !$this->passwordHasher->isPasswordValid($user, $password)) {
            return null; // Retourne null si l'authentification échoue
        }

        return $user;
    }

    public function loginUser(User $user): void
    {
        $session = $this->requestStack->getSession();

        // Détermine le type d'utilisateur en fonction de l'instance de l'entité
        $userType = 'other';  // Valeur par défaut

        if ($user instanceof Client) {
            $userType = 'client';
        } elseif ($user instanceof ServiceClient) {
            $userType = 'serviceClient';
        } elseif ($user instanceof Seller) {
            $userType = 'seller';
        } elseif ($user instanceof Mechanic) {
            $userType = 'mechanic';
        } elseif ($user instanceof CarRentalService) {
            $userType = 'carRentalService';
        } elseif ($user instanceof Admin) {  // Ajout de l'Admin
            $userType = 'admin';
        }

        // Enregistre les informations de l'utilisateur dans la session
        $session->set('user', [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'type' => $userType,
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

    public function isSeller(): bool
    {
        return $this->getUserType() === 'seller';
    }

    public function isMechanic(): bool
    {
        return $this->getUserType() === 'mechanic';
    }

    public function isCarRentalService(): bool
    {
        return $this->getUserType() === 'carRentalService';
    }

    public function isClient(): bool
    {
        return $this->getUserType() === 'client';
    }
}
