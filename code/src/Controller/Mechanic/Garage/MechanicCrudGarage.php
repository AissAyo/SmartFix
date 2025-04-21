<?php

namespace App\Controller\Mechanic\Garage;

use App\Entity\Garage;
use App\Entity\Location;
use App\Form\locationType;
use App\Form\GarageType;
use App\Repository\GarageRepository;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mechanicgarage')]
class MechanicCrudGarage extends AbstractController
{
    #[Route('/', name: 'garage_index', methods: ['GET'])]
    public function index(GarageRepository $garageRepository, LocationRepository $locationRepository): Response
    {
        return $this->render('Mechanic/CRUD/garage/MechanicIndexGarage.html.twig', [
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

        if ($form->isSubmitted()) {
            $newAddress = $form->get('location')->getData();

            if ($newAddress) {
                $latitude = $newAddress->getLatitude();
                $longitude = $newAddress->getLongitude();

                $location = new Location();
                $location->setAddress($newAddress->getAddress());
                $location->setLatitude($latitude);
                $location->setLongitude($longitude);

                $em->persist($location);
                $em->flush();

                $garage->setLocation($location);
            }

            $em->persist($garage);
            $em->flush();

            return $this->redirectToRoute('garage_index');
        }

        return $this->render('Mechanic/CRUD/garage/MechanicAddGarage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'garage_show', methods: ['GET'])]
    public function show(Garage $garage): Response
    {
        return $this->render('Mechanic/CRUD/garage/show.html.twig', [
            'garage' => $garage,
        ]);
    }

    #[Route('/{id}/edit', name: 'garage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Garage $garage): Response
    {
        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newAddress = $form->get('location')->getData();

            if ($newAddress) {
                $existingLocation = $em->getRepository(Location::class)->findOneBy(['address' => $newAddress->getAddress()]);

                if ($existingLocation) {
                    $location = $existingLocation;
                } else {
                    $latitude = $newAddress->getLatitude();
                    $longitude = $newAddress->getLongitude();

                    $location = $garage->getLocation() ?? new Location();
                    $location->setAddress($newAddress->getAddress());
                    $location->setLatitude($latitude);
                    $location->setLongitude($longitude);

                    $em->persist($location);
                    $em->flush();
                }

                $garage->setLocation($location);
            }

            $em->persist($garage);
            $em->flush();

            return $this->redirectToRoute('garage_index');
        }

        return $this->render('Mechanic/CRUD/garage/MechanicEditGarage.html.twig', [
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
