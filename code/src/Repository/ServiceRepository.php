<?php
namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    // You can add custom query methods here if needed

    // Example: Find all services
    public function findAllServices()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.name', 'ASC')  // Ordering services by name as an example
            ->getQuery()
            ->getResult();
    }

    // Example: Find a service by its ID
    public function findServiceById(int $id)
    {
        return $this->find($id);  // Returns the service with the given ID
    }
}
