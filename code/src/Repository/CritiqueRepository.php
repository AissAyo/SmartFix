<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Critique;

class CritiqueRepository implements CritiqueRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityById(int $id): ?Critique
    {
        return $this->entityManager->getRepository(Critique::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(Critique::class)->findAll();
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

    public function getAverageRatingForGarage(int $garageId): float
    {
        $query = $this->entityManager->createQuery(
            'SELECT AVG(c.rating) 
             FROM App\Entity\Critique c 
             WHERE c.garage = :garageId'
        )->setParameter('garageId', $garageId);

        return (float) $query->getSingleScalarResult();
    }

    public function getAverageRatingForSeller(int $sellerId): float
    {
        $query = $this->entityManager->createQuery(
            'SELECT AVG(c.rating) 
             FROM App\Entity\Critique c 
             WHERE c.seller = :sellerId'
        )->setParameter('sellerId', $sellerId);

        return (float) $query->getSingleScalarResult();
    }

    public function getAverageRatingForCarRental(int $carRentalServiceId): float
    {
        $query = $this->entityManager->createQuery(
            'SELECT AVG(c.rating) 
             FROM App\Entity\Critique c 
             WHERE c.carRentalService = :carRentalServiceId'
        )->setParameter('carRentalServiceId', $carRentalServiceId);

        return (float) $query->getSingleScalarResult();
    }
}