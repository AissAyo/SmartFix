<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reservation;
use Doctrine\Persistence\ManagerRegistry;
use \Doctrine\ORM\QueryBuilder;

class ReservationRepository extends ServiceEntityRepository

{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager,ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
        $this->entityManager = $entityManager;
    }

    public function getEntityById(int $id): ?Reservation
    {
        return $this->entityManager->getRepository(Reservation::class)->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->entityManager->getRepository(Reservation::class)
            ->createQueryBuilder('r')
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    public function createQueryBuilder($alias)
//    {
//        return $this->entityManager->getRepository(Reservation::class)
//            ->createQueryBuilder($alias);
//    }

    public function addEntity($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function updateEntity($entity): void
    {
        $this->entityManager->merge($entity);
        $this->entityManager->flush();
    }

    public function deleteEntity($entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
//    public function findReservationDetails()
//    {
//        return $this->createQueryBuilder('r')
//            ->select(
//                'c.name AS client_name',
//                'r.status',
//                'r.reservationDate',
//                'r.notes',
//                's.name AS service_name',
//                'g.name AS garage_name',
//                'l.address',
//                'l.city',
//                'ca.make',
//                'ca.model',
//                'ca.year',
//                'ca.fuelType'
//            )
//            ->join('r.service', 's')
//            ->join('s.categoryService', 'cs')
//            ->join('cs.garage', 'g')
//            ->join('g.location', 'l')
//            ->join('r.vehicle', 'v')
//            ->join('v.carApi', 'ca')
//            ->join('v.client', 'c')
//            ->getQuery()
//            ->getResult();
//    }
    public function getReservationDetails()
    {
        return $this->createQueryBuilder('r')
            ->select(
                'c.name as client_name',
                'r.id ',
                'r.status',
                'r.reservationDate',
                'r.notes',
                's.name as service_name',
                'g.name as garage_name',
                'l.address',
                'l.city',
                'ca.make',
                'ca.model',
                'ca.year',
                'ca.fuelType'
            )
            ->join('r.service', 's')
            ->join('s.categoryService', 'cs')
            ->join('cs.garage', 'g')
            ->join('g.location', 'l')
            ->join('r.vehicle', 'v')
            ->join('v.carAPI', 'ca')
            ->join('v.client', 'c')
            ->getQuery()
            ->getResult();
    }

}
