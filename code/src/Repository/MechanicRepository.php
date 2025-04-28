<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Mechanic;
use Doctrine\Persistence\ManagerRegistry;

class MechanicRepository extends ServiceEntityRepository implements MechanicRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Mechanic::class);
        $this->entityManager = $entityManager;
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
        if (!$entity instanceof Mechanic) {
            throw new \InvalidArgumentException("Expected instance of Mechanic.");
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function deleteEntity($entity): void
    {
        if (!$entity instanceof Mechanic) {
            throw new \InvalidArgumentException("Expected instance of Mechanic.");
        }

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function getMechanicByCity(): array
    {
        $query = $this->entityManager->createQuery('
            SELECT c.city, COUNT(c.id) as city_count
            FROM App\Entity\Mechanic c
            GROUP BY c.city
        ');
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

    public function updateEntity($entity): void
    {
        if (!$entity instanceof Mechanic) {
            throw new \InvalidArgumentException("Expected instance of Mechanic.");
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function getmecha()
    {
        // Code ici si nécessaire
    }
}
