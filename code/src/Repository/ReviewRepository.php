<?php

namespace App\Repository;

use App\Entity\Review;
use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function findByReservation(Reservation $reservation): array
    {
        return $this->createQueryBuilder('r')
            ->where('r.reservation = :reservation')
            ->setParameter('reservation', $reservation)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}