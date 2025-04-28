<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\Client\ReservationService;
use App\Entity\Client;
use App\Service\AuthService;
use App\Service\ReviewService;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Review;
use App\Entity\Reservation;

/**
 * @author Your Name
 */
final class HistoryClientController extends AbstractController
{
  #[Route('/history/client/{page<\d+>?1}', name: 'app_history_client')]
  public function index(
      Request $request,
      ReservationService $reservationService,
      AuthService $authService,
      int $page = 1
  ): Response {
      $user = $authService->getUser();
      
      if (!$user) {
          throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page');
      }
      
      if (!$user instanceof Client) {
          throw $this->createAccessDeniedException('Accès réservé aux clients');
      }
  
      $status = $request->query->get('status');
      
      // D'abord, obtenir le nombre total de réservations
      $totalReservations = $reservationService->getTotalReservationsForClient($user, $status);
      
      // Ensuite, obtenir les réservations paginées
      $reservations = $reservationService->getReservationsForClient($user, $page, 6, $status);
      
      $statusOptions = $reservationService->getStatusOptions();
  
      // Créer un tableau de pagination
      $pagination = new \stdClass();
      $pagination->currentPageNumber = $page;
      $pagination->pageCount = ceil($totalReservations / 6);
      $pagination->itemsPerPage =6;
 
      return $this->render('history_client/index.html.twig', [
          'reservations' => $reservations,
          'pagination' => $pagination,
          'statusOptions' => $statusOptions,
          'selectedStatus' => $status
      ]);
  }

    #[Route('/client/reservation/cancel/{id}', name: 'client_reservation_cancel')]
    public function cancel(
        int $id,
        ReservationService $reservationService,
        AuthService $authService
    ): Response {
        $user = $authService->getUser();
        
        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page');
        }
        
        if (!$user instanceof Client) {
            throw $this->createAccessDeniedException('Accès réservé aux clients');
        }

        try {
            $reservationService->cancelReservation($id, $user);
            $this->addFlash('success', 'La réservation a été annulée avec succès.');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de l\'annulation de la réservation.');
        }

        return $this->redirectToRoute('app_history_client');
    }

  #[Route('/client/reservation/review/{id}', name: 'client_reservation_review_form', methods: ['GET'])]
  public function reviewForm(
      int $id,
      EntityManagerInterface $entityManager,
      AuthService $authService
  ): Response {
      $user = $authService->getUser();
      
      if (!$user) {
          throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page');
      }
      
      if (!$user instanceof Client) {
          throw $this->createAccessDeniedException('Accès réservé aux clients');
      }
  
      try {
          $reservation = $entityManager->getRepository(Reservation::class)
              ->findBy(['id' => $id, 'client' => $user]);
          
          if (!$reservation) {
              throw new \Exception('Reservation not found');
          }
      } catch (\Exception $e) {
          $this->addFlash('error', 'Une erreur est survenue lors de l\'annulation de la réservation.');
      }
  
      return $this->redirectToRoute('app_history_client');
  }

    #[Route('/client/reservation/review/submit', name: 'client_reservation_review_submit', methods: ['POST'])]
    public function submitReview(
        Request $request,
        ReviewService $reviewService,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        try {
            $data = json_decode($request->getContent(), true);
            
            if (!$data) {
                throw new \Exception('Invalid request data');
            }
    
            $reservationId = $data['reservationId'] ?? null;
            $rating = $data['rating'] ?? null;
            $comment = $data['comment'] ?? null;
    
            if (!$reservationId || !$rating || !$comment) {
                throw new \Exception('Missing required fields');
            }
    
            error_log('Reservation ID: ' . $reservationId);
            error_log('Rating: ' . $rating);
            error_log('Comment: ' . $comment);
    
            $reservation = $entityManager->getRepository(Reservation::class)->find($reservationId);
            if (!$reservation) {
                throw new \Exception('Reservation not found');
            }
    
            $reviewService->createReview($reservationId, $rating, $comment);
            
            return new JsonResponse(['message' => 'Review submitted successfully']);
        } catch (\Exception $e) {
            error_log('Error in submitReview: ' . $e->getMessage());
            error_log('Stack trace: ' . $e->getTraceAsString());
            
            return new JsonResponse([
                'error' => $e->getMessage(),
                'debug' => $e->getTraceAsString()
            ], 500);
        }
    }
}