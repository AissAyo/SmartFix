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
    public function findReviewsByGarage(int $garageId): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.reservation', 'res')
            ->join('res.service', 's')
            ->join('res.vehicle', 'v')
            ->join('v.client', 'c')
            ->join('s.categoryService', 'cs')
            ->join('cs.garage', 'g')
            ->where('g.id = :garageId')
            ->setParameter('garageId', $garageId)
            ->getQuery()
            ->getResult();
    }

}