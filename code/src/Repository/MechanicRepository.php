<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Mechanic;
use Doctrine\Persistence\ManagerRegistry;


class MechanicRepository extends ServiceEntityRepository implements MechanicRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mechanic::class);

        $this->entityManager = $registry->getManager();
    }

    public function getEntityById(int $id): ?Mechanic
    {
        return $this->entityManager->getRepository(Mechanic::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(Mechanic::class)->findAll();
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

    public function deleteEntity($entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
    public function getMechanicByCity(): array
    {
        // Corrected: Use $this->entityManager, not $manager
        $query = $this->entityManager->createQuery('
            SELECT c.city, COUNT(c.id) as city_count
            FROM App\Entity\Mechanic c
            GROUP BY c.city
            
        ');
        // if you're using Symfony with debug enabled
        return $query->getResult();
    }
    public function findOneByEmail(string $email): ?Mechanic
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}