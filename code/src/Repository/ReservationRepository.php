<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
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

    public function createQueryBuilder($alias)
    {
        return $this->entityManager->getRepository(Reservation::class)
            ->createQueryBuilder($alias);
    }
   public function countReservationsForClient(Client $client, ?string $status = null): int
   {
       $qb = $this->createQueryBuilder('r')
           ->innerJoin('r.vehicle', 'v')
           ->where('v.client = :client')
           ->setParameter('client', $client);
   
       if ($status !== null && $status !== '') {
           $qb->andWhere('LOWER(r.status) = :status')
              ->setParameter('status', strtolower($status));
       }
   
       return $qb->select('COUNT(r)')
                 ->getQuery()
                 ->getSingleScalarResult();
   }

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
}