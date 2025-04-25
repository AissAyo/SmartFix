<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientGarageListingController extends AbstractController
{
    #[Route('/garages', name: 'app_garages')]
    public function index(): Response
    {

        
        return $this->render('services/GaragesListing.html.twig', [
            'controller_name' => 'GarageController',
        ]);
    }
} 