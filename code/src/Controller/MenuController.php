<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\AuthClient\AuthClientService;
class MenuController extends AbstractController
{
    #[Route('/user-menu', name: 'app_user_menu')]
    public function userMenu(AuthClientService $authService,): Response
    {
        // Vérifie si l'utilisateur est connecté
        $isLoggedIn = $authService->isLoggedIn();

        // Passe cette variable au template Twig
        return $this->render('partials/_user_menu.html.twig', [
            'isLoggedIn' => $isLoggedIn,
        ]);

    }
}
