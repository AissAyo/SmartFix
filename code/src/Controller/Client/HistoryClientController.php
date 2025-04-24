<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\Client\ReservationService;
use App\Entity\Client;
use App\Service\AuthService;

final class HistoryClientController extends AbstractController
{
    #[Route('/history/client/{page<\d+>?1}', name: 'app_history_client')]
    public function index(
        Request $request,
        ReservationService $reservationService,
        int $page = 1,
        AuthService $authService
    ): Response {
        $user = $authService->getUser();
        //$user = $this->getUser();
        
        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page');
        }
        
        if (!$user instanceof Client) {
            throw $this->createAccessDeniedException('Accès réservé aux clients');
        }

        $status = $request->query->get('status');
        $reservations = $reservationService->getReservationsForClient($user, $page, 10, $status);
        $statusOptions = $reservationService->getStatusOptions();

        return $this->render('history_client/index.html.twig', [
            'reservations' => $reservations,
            'pagination' => $reservations,
            'statusOptions' => $statusOptions,
            'selectedStatus' => $status
        ]);
    }
}