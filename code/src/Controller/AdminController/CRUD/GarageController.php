<?php

namespace App\Controller\AdminController\CRUD;

use App\Entity\Garage;
use App\Entity\Location;
use App\Entity\Service;
use App\Entity\CategoryService;
use App\Repository\LocationRepository;
use App\Form\locationType;
use App\Form\GarageType;
use App\Repository\GarageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admingarage')]
class GarageController extends AbstractController
{
    #[Route('/', name: 'garage_index', methods: ['GET'])]
    public function index(GarageRepository $garageRepository, LocationRepository $locationRepository): Response
    {
        return $this->render('Admin/CRUD/garage/MechanicIndexGarage.html.twig', [
            'garages' => $garageRepository->findAll(),
            'location' => $locationRepository->getAllEntities(),
        ]);
    }

    #[Route('/new', name: 'garage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $garage = new Garage();
        $form = $this->createForm(GarageType::class, $garage);

        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            // Getting the new address data from the form
            $newAddress = $form->get('location')->getData(); // 'newAddress' field in your form
            //dd($newAddress);

            if ($newAddress) {
                // Assuming that you're getting latitude and longitude, either from the form or geocoding API
                // Example of hardcoded coordinates for simplicity, replace with actual logic if needed
                $latitude = 0.0; // You could get this value from a geocoding service
                $longitude = 0.0; // Likewise, fetch the longitude from a geocoding service

                // Create new Location entity and set the address, latitude, and longitude
                $location = new Location();
                $location->setAddress($newAddress->getaddress());
                $location->setLatitude($newAddress->getlatitude());
                $location->setLongitude($newAddress->getlongitude());

                // Persist the new location to the database
                $em->persist($location);
                $em->flush(); // Save location to DB

                // Assign the newly created location to the garage
                $garage->setLocation($location);

            }

            // Persist the new garage
            $em->persist($garage);
            $em->flush(); // Save garage to DB

            // Redirect after successful creation
            return $this->redirectToRoute('garage_index'); // Adjust route as needed
        }

        // Render the form
        return $this->render('Admin/CRUD/garage/MechanicAddGarage.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'garage_show', methods: ['GET'])]
    public function show(Garage $garage): Response
    {
        return $this->render('Admin/CRUD/garage/show.html.twig', [
            'garage' => $garage,
        ]);
    }

    #[Route('/{id}/edit', name: 'garage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Garage $garage): Response
    {
        // Create a form to edit the garage
        $form = $this->createForm(GarageType::class, $garage);

        // Handle the form submission
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle the location editing if necessary
            $newAddress = $form->get('location')->getData();

            if ($newAddress) {
                // Check if the address already exists in the database
                $existingLocation = $em->getRepository(Location::class)->findOneBy(['address' => $newAddress->getAddress()]);

                if ($existingLocation) {
                    // If the address already exists, use the existing location
                    $location = $existingLocation;
                } else {
                    // Otherwise, update the location
                    $latitude = $newAddress->getLatitude();
                    $longitude = $newAddress->getLongitude();

                    // Update location or create a new one
                    $location = $garage->getLocation() ?? new Location();
                    $location->setAddress($newAddress->getAddress());
                    $location->setLatitude($latitude);
                    $location->setLongitude($longitude);

                    // Persist the location
                    $em->persist($location);
                    $em->flush();
                }

                // Update the location of the garage
                $garage->setLocation($location);
            }

            // Persist the updated garage
            $em->persist($garage);
            $em->flush();

            // Redirect to the garage index or a success page
            return $this->redirectToRoute('garage_index');
        }

        // Render the edit form view
        return $this->render('Admin/CRUD/garage/MechanicEditGarage.html.twig', [
            'form' => $form->createView(),
            'garage' => $garage,
        ]);
    }


    #[Route('/{id}', name: 'garage_delete', methods: ['POST'])]
    public function delete(Request $request, Garage $garage, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $garage->getId(), $request->request->get('_token'))) {
            $em->remove($garage);
            $em->flush();
        }

        return $this->redirectToRoute('garage_index');
    }
}
