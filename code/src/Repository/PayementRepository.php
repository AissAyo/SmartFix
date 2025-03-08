<?php

namespace App\Repository;

use App\Entity\Payement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payement>
 *
 * @method Payement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payement[]    findAll()
 * @method Payement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payement::class);
    }

    // Add your custom repository methods here
}