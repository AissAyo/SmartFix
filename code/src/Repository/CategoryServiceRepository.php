<?php

namespace App\Repository;

use App\Entity\CategoryService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryService::class);
    }

    public function findAllWithServices(): array
    {
        return $this->createQueryBuilder('c')
            ->innerJoin('c.services', 's')
            ->addSelect('s')
            ->orderBy('c.Categoryname', 'ASC')
            ->getQuery()
            ->getResult();
    }
}