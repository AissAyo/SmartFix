<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestNavController extends AbstractController
{
    #[Route('/testnav', name: 'app_test_nav')]
    public function index(): Response
    {
        return $this->render('test_nav/MechanicIndexGarage.html.twig', [
            'controller_name' => 'TestNavController',
        ]);
    }
}
