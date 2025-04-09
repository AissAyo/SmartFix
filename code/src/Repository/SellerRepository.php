<?php
namespace App\Repository;

use App\Entity\Seller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class SellerRepository extends ServiceEntityRepository implements SellerRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Seller::class);
        $this->entityManager = $entityManager;
    }

    public function getEntityById(int $id): ?Seller
    {
        return $this->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->findAll();
    }

    public function addEntity($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function updateEntity($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function deleteEntity($entity, bool $flush = false): void
    {
        // Remove the entity
        $this->entityManager->remove($entity);

        // Flush the entity manager to apply the changes
        if ($flush) {
            $this->entityManager->flush();
        }
    }

}