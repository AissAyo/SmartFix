<?php

namespace App\Repository;

use App\Entity\Garage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


class GarageRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Garage::class);
        $this->entityManager = $registry->getManager();

    }

    public function getgarageByCity(): array
    {
        // Corrected: Use $this->entityManager, not $manager
        $query = $this->entityManager->createQuery('
            SELECT g.City, COUNT(g.id) as city_count
            FROM App\Entity\Garage g
            GROUP BY g.City
        ');
        // if you're using Symfony with debug enabled
        return $query->getResult();
    }
    // Add custom query methods here
}
