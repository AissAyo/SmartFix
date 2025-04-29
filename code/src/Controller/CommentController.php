<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ReviewService;

final class CommentController extends AbstractController
{
    #[Route('/garage/{id}/reviews', name: 'app_comment')]
    public function index(int $id, ReviewService $reviewService): Response
    {

        // Récupérer les reviews du garage
        $reviews = $reviewService->getReviewsByGarage($id);
        return $this->render('page_comment/index.html.twig', [
            'reviews' => $reviews,
        ]);
    }

}
