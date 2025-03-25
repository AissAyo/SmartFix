<?php

namespace App\Service\CRUD;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientService
{
    private ClientRepository $clientRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(ClientRepository $clientRepository, EntityManagerInterface $entityManager)
    {
        $this->clientRepository = $clientRepository;
        $this->entityManager = $entityManager;
    }

    public function getClient(int $id): ?Client
    {
        return $this->clientRepository->getEntityById($id);
    }

    public function getAllClients(): array
    {
        return $this->clientRepository->getAllEntities();
    }

    public function createClient(Client $client): void
    {
        $this->clientRepository->addEntity($client);
    }

    public function updateClient(Client $client): void
    {
        $this->clientRepository->updateEntity($client);
    }

    public function deleteClient(Client $client): void
    {
        $this->clientRepository->deleteEntity($client, true);
    }
}
