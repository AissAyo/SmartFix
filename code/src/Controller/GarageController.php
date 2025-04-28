<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Type\ReservationType;
use App\Service\Client\GarageService;
use App\Service\python_http\GarageMatchService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vehicule;
use App\Entity\Service;


class GarageController extends AbstractController
{
    public function __construct(
        private GarageService $garageService,
        private GarageMatchService $garageMatchService
    ) {}

    #[Route('/garages', name: 'app_garages')]
    public function index(Request $request): Response
    {
        $garages = $this->garageService->getPaginatedGarages($request);
        
        // Get recommended garages if user is logged in
        $recommendedGarages = [];
        if ($this->getUser()) {
            $clientId = $this->getUser()->getId();
            $recommendations = $this->garageMatchService->getMatchedGarages($clientId);
            if ($recommendations && isset($recommendations['matched_garages'])) {
                $recommendedGarages = $this->garageService->getGaragesByIds($recommendations['matched_garages']);
            }
        }

        return $this->render('services/GaragesListing.html.twig', [
            'garages' => $garages,
            'recommendedGarages' => $recommendedGarages
        ]);
    }
    #[Route('/garages/{id}', name: 'app_garage_show')]
    public function show(int $id): Response
    {
        $garage = $this->garageService->getGarageById($id);

        return $this->render('services/GarageDetails.html.twig', [
            'garage' => $garage,
        ]);
    }

    #[Route('/garages/{id}/reservation', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function newReservation(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $garage = $this->garageService->getGarageById($id);
        if (!$garage) {
            throw $this->createNotFoundException('Garage not found');
        }

        $reservation = new Reservation();
        $reservation->setStatus('pending');

        // Get service and vehicle IDs from query parameters
        $serviceId = $request->query->get('serviceId');
        $vehicleId = $request->query->get('vehicleId');

        // If service ID is provided, find and set the service
        if ($serviceId) {
            $service = $entityManager->getRepository(Service::class)->find($serviceId);
            if ($service) {
                $reservation->setService($service);
                // Set the estimated price based on the service price
                $reservation->setEstimatedPrice($service->getPrice());
            }
        }

        // If vehicle ID is provided, find and set the vehicle
        if ($vehicleId) {
            $vehicle = $entityManager->getRepository(Vehicule::class)->find($vehicleId);
            if ($vehicle) {
                $reservation->setVehicle($vehicle);
            }
        }

        // Set default reservation date to now
        $reservation->setReservationDate(new \DateTime());

        // Initialize empty notes
        $reservation->setNotes('');

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            $this->addFlash('success', 'Reservation created successfully!');
            return $this->redirectToRoute('app_garage_show', ['id' => $id]);
        }

        return $this->render('services/ReservationClient.html.twig', [
            'form' => $form->createView(),
            'garage' => $garage,
        ]);
    }
} 