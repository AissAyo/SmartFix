<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Garage;
use App\Entity\Mechanic;

class GarageRepository 
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityById(int $id): ?Garage
    {
        return $this->entityManager->getRepository(Garage::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(Garage::class)->findAll();
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
    public function getGaragesByMechanic(Mechanic $mechanic): array
    {
        return $this->entityManager->getRepository(Garage::class)
            ->createQueryBuilder('g')
            ->where('g.mechanic = :mechanic')
            ->setParameter('mechanic', $mechanic)
            ->getQuery()
            ->getResult();
    }
}