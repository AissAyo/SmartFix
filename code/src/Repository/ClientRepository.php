<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

class ClientRepository implements ClientRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityById(int $id): ?Client
    {
        return $this->entityManager->getRepository(Client::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(Client::class)->findAll();
    }

    public function addEntity($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function updateEntity($entity): void
    {
        $this->entityManager->merge($entity);
        $this->entityManager->flush();
    }

    public function deleteEntity($entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
    public function getClientByCity(): array
    {
        // Corrected: Use $this->entityManager, not $manager
        $query = $this->entityManager->createQuery('
            SELECT c.city, COUNT(c.id) as city_count
            FROM App\Entity\Client c
            GROUP BY c.city
        ');

        return $query->getResult();
    }
    public function getClientBystatus(): array
    {
        // Correcting the GROUP BY clause syntax
        $query = $this->entityManager->createQuery('
        SELECT c.verificationStatus, COUNT(c.id) as client_count
        FROM App\Entity\Client c
        GROUP BY c.verificationStatus
    ');

        // Execute the query and return the result
        return $query->getResult();
    }

}