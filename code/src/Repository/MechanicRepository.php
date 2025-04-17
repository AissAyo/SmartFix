<?php
namespace App\Repository;

    use Doctrine\ORM\EntityManagerInterface;
    use App\Entity\Mechanic;


    class MechanicRepository implements MechanicRepositoryInterface
    {
        private EntityManagerInterface $entityManager;

        public function __construct(EntityManagerInterface $entityManager)
        {
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
    }