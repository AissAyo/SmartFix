<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ServiceClient;

class ServiceClientRepository implements ServiceClientRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityById(int $id): ?ServiceClient
    {
        return $this->entityManager->getRepository(ServiceClient::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(ServiceClient::class)->findAll();
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
}