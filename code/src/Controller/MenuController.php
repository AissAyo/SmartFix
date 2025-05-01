<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\AuthService;

class MenuController extends AbstractController
{
    #[Route('/user-menu', name: 'app_user_menu')]
    public function userMenu(AuthService $authService,): Response
    {
        // Vérifie si l'utilisateur est connecté
        $isLoggedIn = $authService->isLoggedIn();

        $isClient = $authService->isClient();
        $isMechanic = $authService->isMechanic();
        // Passe cette variable au template Twig
        return $this->render('partials/_user_menu.html.twig', [
            'isLoggedIn' => $isLoggedIn,
            'isClient' => $isClient,
            'isMechanic' => $isMechanic ,
        ]);

    }
}
