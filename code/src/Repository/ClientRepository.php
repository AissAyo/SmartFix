<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager , ManagerRegistry $registry)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Client::class);
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
}