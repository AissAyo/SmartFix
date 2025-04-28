<?php

namespace App\Service;

use App\Entity\Review;
use App\Entity\Reservation;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ReviewService
{
    private $reviewRepository;
    private $entityManager;

    public function __construct(
        ReviewRepository $reviewRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->entityManager = $entityManager;
    }

    public function createReview(int $reservationId, int $rating, string $comment)
    {
        try {
            // Get the reservation
            $reservation = $this->entityManager->getRepository(Reservation::class)->find($reservationId);
            
            if (!$reservation) {
                throw new \Exception('Reservation not found');
            }

            // Create and persist the review
            $review = new Review();
            $review->setReservation($reservation);
            $review->setRating($rating);
            $review->setComment($comment);
            $review->setCreatedAt(new \DateTime());

            // Persist the review
            $this->entityManager->persist($review);
            
            // Flush the changes
            try {
                $this->entityManager->flush();
            } catch (OptimisticLockException $e) {
                throw new \Exception('Optimistic lock exception: ' . $e->getMessage());
            } catch (ORMException $e) {
                throw new \Exception('ORM exception: ' . $e->getMessage());
            }
            
        } catch (\Exception $e) {
            // Debugging: Log the error
            error_log('Error in createReview: ' . $e->getMessage());
            error_log('Stack trace: ' . $e->getTraceAsString());
            
            throw new \Exception('Error creating review: ' . $e->getMessage());
        }
    }
}