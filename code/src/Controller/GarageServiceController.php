<?php

namespace App\Controller;

use App\Repository\GarageServiceRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/garage-services")
 */
class GarageServiceController extends AbstractController
{
    public function services(
        GarageServiceRepository $garageServiceRepository,
        Request $request,
        VehiculeRepository $vehiculeRepository
    ): Response {
        $vehicleId = $request->query->get('vehicleId');
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = 10;

        if ($vehicleId) {
            // Cas 1: Véhicule sélectionné
            $vehicule = $vehiculeRepository->find($vehicleId);
            if ($vehicule) {
                // Récupérer tous les services pour ce véhicule
                $garageServices = $garageServiceRepository->findByVehicleWithPagination($page, $itemsPerPage, $vehicule);
                $totalServices = $garageServiceRepository->countForVehicle($vehicule);
                $totalPages = ceil($totalServices / $itemsPerPage);
                
                return $this->render('services/services-list.html.twig', [
                    'garageServices' => $garageServices,
                    'selectedVehicle' => $vehicule,
                    'currentPage' => $page,
                    'itemsPerPage' => $itemsPerPage,
                    'totalPages' => $totalPages,
                    'vehicles' => $vehiculeRepository->findAll()
                ]);
            }
        } else {
            // Cas 2: Pas de véhicule sélectionné (afficher tous les services)
            // Récupérer tous les services avec pagination
            $garageServices = $garageServiceRepository->findAllWithPagination($page, $itemsPerPage);
            $totalServices = $garageServiceRepository->countAll();
            $totalPages = ceil($totalServices / $itemsPerPage);
            
            return $this->render('services/services-list.html.twig', [
                'garageServices' => $garageServices,
                'currentPage' => $page,
                'itemsPerPage' => $itemsPerPage,
                'totalPages' => $totalPages,
                'vehicules' => $vehiculeRepository->findAll()
            ]);
        }

        // Si on arrive ici, il y a une erreur (véhicule non trouvé)
        throw $this->createNotFoundException('Vehicle not found');
    }
}