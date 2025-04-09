<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;  // Assuming Service is an Entity

class ServiceController extends AbstractController
{
    #[Route('/services', name: 'services')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        // Fetch all services from the database
        $services = $serviceRepository->findAll();

        // Pass the services data to the Twig template
        return $this->render('services/index.html.twig', [
            'services' => $services,
        ]);
    }
    #[Route(name: 'mecanics', path: '/mecanics')]
    public function mecanics(): Response
    {
        return $this->render('page/services.html.twig');
    }

}
