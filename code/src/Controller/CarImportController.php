<?php

namespace App\Controller;

use App\Service\CarApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarImportController extends AbstractController
{
    #[Route('/import-cars', name: 'import_cars')]
    public function importCars(CarApiService $carApiService): Response
    {
        $carApiService->fetchAndStoreCarData();

        return new Response('Car data imported successfully!');
    }
}
