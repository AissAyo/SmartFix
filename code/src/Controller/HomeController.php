<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\component\Httpfoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/Home', name: 'app_home')]
    public function index(Request $request): Response
    {
        return $this->render('home/Home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
