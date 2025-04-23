<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\VerifiedClient;

class VerifiedClientRepository implements RepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    // Implémentation de la méthode findBy
    public function findBy(array $criteria): array
    {
        return $this->entityManager->getRepository(Vehicule::class)->findBy($criteria);
    }

    public function getEntityById(int $id): ?VerifiedClient
    {
        return $this->entityManager->getRepository(VerifiedClient::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(VerifiedClient::class)->findAll();
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