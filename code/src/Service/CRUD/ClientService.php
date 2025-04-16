<?php

namespace App\Service\CRUD;

use App\Entity\Client;
use App\Repository\ClientRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

class ClientService
{

    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private Security $security  // <-- Add this
    ) {}

    public function getClient(int $id): ?Client
    {
        return $this->clientRepository->getEntityById($id);
    }

    public function getAllClients(): array
    {
        return $this->clientRepository->getAllEntities();
    }

    public function saveClient(Client $client, bool $flush = true): void
    {
        $this->clientRepository->save($client, $flush);
    }

    public function deleteClient(Client $client, bool $flush = true): void
    {
        $this->clientRepository->remove($client, $flush);
    }

    public function existsByEmail(?string $email): bool
    {
        return $this->clientRepository->existsByEmail($email);
    }

    public function phoneExists(string $phone): bool
    {
        return $this->clientRepository->phoneExists($phone);
    }

    public function getCurrentClient(): ?Client
    {
        $user = $this->security->getUser();
        return $user instanceof Client ? $user : null;
    }

}