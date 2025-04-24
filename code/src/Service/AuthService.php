<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Client;
use App\Entity\Garagiste;
use App\Entity\mechanic;
use App\Entity\ServiceClient;
use App\Repository\UserRepository;
 

class AuthService
{
    private ClientRepository $ClientRepository;
    private RequestStack $requestStack;
    private UserRepository $userRepository;

    public function __construct(
        ClientRepository $ClientRepository,
        RequestStack $requestStack,
        UserRepository $userRepository
    ) {
        $this->ClientRepository = $ClientRepository;
        $this->requestStack = $requestStack;
        $this->userRepository = $userRepository;
    }

    public function authenticate(string $email, string $password): ?User
    {
        $user = $this->userRepository->findUserByEmail($email);

        if (!$user || $user->getPassword() !== $password) {
            return null;
        }

        return $user;
    }

    public function loginUser(User $user): void
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

    public function getUser(): ?User
    {
        $session = $this->requestStack->getSession();
        $userData = $session->get('user');  // Récupérer l'utilisateur de la session

        if (!$userData || !isset($userData['id'])) {
            return null;  // Retourne null si aucun utilisateur trouvé
        }

        // Ici on utilise le repository pour la classe Client ou Garagiste
        return $this->ClientRepository->find($userData['id']);  // Recherche par ID dans la table 'client'
    }

    public function getUserType(): ?string
    {
        $user = $this->getUser();
        return $user ? get_class($user) : null;
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
