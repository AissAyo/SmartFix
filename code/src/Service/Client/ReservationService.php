<?php

namespace App\Service\Client;

use App\Repository\ReservationRepository;
use App\Entity\Client;
use Knp\Component\Pager\PaginatorInterface;

class ReservationService
{
    private $reservationRepository;
    private $paginator;

    public function __construct(
        ReservationRepository $reservationRepository,
        PaginatorInterface $paginator
    ) {
        $this->reservationRepository = $reservationRepository;
        $this->paginator = $paginator;
    }

    public function getReservationsForClient(Client $client, int $page = 1, int $limit = 10, ?string $status = null)
    {
        $query = $this->reservationRepository->createQueryBuilder('r')
            ->innerJoin('r.vehicle', 'v')
            ->where('v.client = :client')
            ->setParameter('client', $client);

        if ($status && $status !== '') {
            $query->andWhere('r.status = :status')
                ->setParameter('status', $status);
        }

        $query->orderBy('r.reservationDate', 'DESC');

        return $this->paginator->paginate(
            $query->getQuery(),
            $page,
            $limit
        );
    }

    public function getStatusOptions(): array
    {
        return [
            '' => 'All Statuses',
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled'
        ];
    }

    public function cancelReservation(int $reservationId, Client $client)
    {
        $reservation = $this->reservationRepository->find($reservationId);

        if (!$reservation) {
            throw new \Exception('Reservation not found');
        }

        if ($reservation->getStatus() !== 'PENDING') {
            throw new \Exception('Only pending reservations can be cancelled');
        }

        // Delete the reservation
        $this->reservationRepository->remove($reservation, true);
    }
}
