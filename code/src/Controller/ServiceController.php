<?php


namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Service\AuthService;
use App\Service\GarageServiceService;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\VehiculeRepository;
use App\Repository\CategoryServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GarageServiceRepository;

/**
 * @Route("services")
 */
class ServiceController extends AbstractController
{
    

    #[Route('/mecanics', name: 'mecanics')]
    public function mecanics(
        SessionInterface $session,
        VehiculeRepository $vehiculeRepository,
        AuthService $authService,
        GarageServiceService $garageServiceService,
        RequestStack $requestStack,
        GarageServiceRepository $garageServiceRepository,
        Request $request,
        CategoryServiceRepository $categoryServiceRepository,
        ServiceRepository $serviceRepository
    ): Response {
        //dump($session->all()); die;








        $user = $authService->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        $userId = $user?->getId();


    
        $vehicules = $vehiculeRepository->findBy(['client' => $userId]);


        $categories = $categoryServiceRepository->findAllWithServices();
    
        $vehicleId = $request->query->get('vehicleId');
        $serviceId = $request->query->get('serviceId');
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = 9;
    
        // Cas 3 : Véhicule + Service sélectionnés
        if ($vehicleId && $serviceId) {
            $vehicule = $vehiculeRepository->find($vehicleId);
            if ($vehicule) {
                $carAPI = $vehicule->getCarAPI();
                $garageServices = $garageServiceRepository->findByCarAPIAndServiceWithPagination($page, $itemsPerPage, $carAPI, $serviceId);
                $totalServices = $garageServiceRepository->countByCarAPIAndService($carAPI, $serviceId);
                $totalPages = ceil($totalServices / $itemsPerPage);
    
                return $this->render('page/services.html.twig', [
                    'garageServices' => $garageServices,
                    'selectedVehicle' => $vehicule,
                    'selectedServiceId' => $serviceId,
                    'currentPage' => $page,
                    'itemsPerPage' => $itemsPerPage,
                    'totalPages' => $totalPages,
                    'vehicules' => $vehicules,
                    'categories' => $categories,
                ]);
            }
        }
    
        // Cas 2 : Service seulement sélectionné
        if ($serviceId) {
            $garageServices = $garageServiceRepository->findByServiceWithPagination($page, $itemsPerPage, $serviceId);
            $totalServices = $garageServiceRepository->countByService($serviceId);
            $totalPages = ceil($totalServices / $itemsPerPage);
    
            return $this->render('page/services.html.twig', [
                'garageServices' => $garageServices,
                'selectedServiceId' => $serviceId,
                'currentPage' => $page,
                'itemsPerPage' => $itemsPerPage,
                'totalPages' => $totalPages,
                'vehicules' => $vehicules,
                'categories' => $categories,
            ]);
        }
    
        // Cas 1 : Seulement véhicule sélectionné → code existant à NE PAS TOUCHER
        if ($vehicleId) {

            $vehicule = $vehiculeRepository->find($vehicleId);
            if ($vehicule) {
                $garageServices = $garageServiceRepository->findByVehicleWithPagination($page, $itemsPerPage, $vehicule);
                $totalServices = $garageServiceRepository->countForVehicle($vehicule);
                $totalPages = ceil($totalServices / $itemsPerPage);
                
                return $this->render('page/services.html.twig', [
                    'garageServices' => $garageServices,
                    'selectedVehicle' => $vehicule,
                    'currentPage' => $page,
                    'itemsPerPage' => $itemsPerPage,
                    'totalPages' => $totalPages,
                    'vehicules' => $vehicules,
                    'categories' => $categories,
                ]);
            }
        }
    
        // Cas défaut : tout afficher
        $garageServices = $serviceRepository->findAllWithPagination($page, $itemsPerPage);
        //$garageServices = $garageServiceRepository->findAllWithPagination($page, $itemsPerPage);
        $totalServices = $serviceRepository->countAll();
        //$totalServices = $garageServiceRepository->countAll();
        $totalPages = ceil($totalServices / $itemsPerPage);
    
        return $this->render('page/services.html.twig', [
            'garageServices' => $garageServices,
            'currentPage' => $page,
            'itemsPerPage' => $itemsPerPage,
            'totalPages' => $totalPages,
            'vehicules' => $vehicules,
            'categories' => $categories,
        ]);
    }
    
 
}
