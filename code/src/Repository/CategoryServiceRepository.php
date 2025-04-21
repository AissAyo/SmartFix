<?php

// src/Repository/CategoryServiceRepository.php
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

    // You can add custom queries here, if needed.
}
