<?php

namespace App\Service\Client;

use App\Repository\ReservationRepositoryInterface;
use App\Entity\Client;
use Knp\Component\Pager\PaginatorInterface;

class ReservationService
{
    private $reservationRepository;
    private $paginator;

    public function __construct(
        ReservationRepositoryInterface $reservationRepository,
        PaginatorInterface $paginator
    ) {
        $this->reservationRepository = $reservationRepository;
        $this->paginator = $paginator;
    }

    public function getReservationsForClient(Client $client, int $page = 1, int $limit = 10, ?string $status = null)
   {
       $query = $this->reservationRepository->createQueryBuilder('r')
           ->innerJoin('r.vehicle', 'v')
           ->innerJoin('r.service', 's')
           ->innerJoin('s.categoryService', 'c')
           ->innerJoin('c.garage', 'g')
           ->where('v.client = :client')
           ->setParameter('client', $client);

       if ($status !== null && $status !== '') {
           $query->andWhere('LOWER(r.status) = :status')
                 ->setParameter('status', strtolower($status));
       }

       $query->orderBy('r.reservationDate', 'DESC');

       return $this->paginator->paginate(
           $query,
           $page,
           $limit
       );
   }

   public function getTotalReservationsForClient(Client $client, ?string $status = null): int
   {
       $qb = $this->reservationRepository->createQueryBuilder('r')
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

    public function getStatusOptions(): array
    {
        return [
            '' => 'All Statuses',
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'in_progress' => 'In Progress',
            'completed' => 'Completed'
        ];
    }
    public function cancelReservation(int $reservationId, Client $client)
    {
        $reservation = $this->reservationRepository->getEntityById($reservationId);
    
        if (!$reservation) {
            throw new \Exception('Reservation not found');
        }
    
        if ($reservation->getStatus() !== 'PENDING') {
            throw new \Exception('Only pending reservations can be cancelled');
        }
    
        // Delete the reservation
        $this->reservationRepository->deleteEntity($reservation);
    }
}