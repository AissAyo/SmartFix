<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Seller;

class SellerRepository extends ServiceEntityRepository implements SellerRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityById(int $id): ?Seller
    {
        return $this->entityManager->getRepository(Seller::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(Seller::class)->findAll();
    }

    public function addEntity($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function updateEntity($entity): void
    {
        $this->entityManager->flush();
    }
    

    public function deleteEntity($entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
    public function save(Seller $seller): void
    {
        $this->_em->persist($seller);
        $this->_em->flush();
    }

    public function delete(Seller $seller): void
    {
        $this->_em->remove($seller);
        $this->_em->flush();
    }
}