<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ServiceRepository  extends ServiceEntityRepository implements ServiceRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function findAllWithPagination(int $page, int $itemsPerPage): array
    {
        $qb = $this->entityManager->createQueryBuilder()
            ->select('s')
            ->from(Service::class, 's')
            ->setFirstResult(($page - 1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage);

        return $qb->getQuery()->getResult();
    }
    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('s')
            ->select('COUNT(s)')
            ->getQuery()
            ->getSingleScalarResult();
    }


    public function getEntityById(int $id): ?Service
    {
        return $this->entityManager->getRepository(Service::class)->find($id);
    }


    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(Service::class)->findAll();
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