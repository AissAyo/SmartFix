<?php

namespace App\Controller\Garages;

use App\Controller\AdminController\CRUD\GarageController;
use App\Repository\GarageRepository;
use App\Repository\LocationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class GaragesController extends abstractController
{

    #[Route('/AllGarages', name: 'all_garage_index', methods: ['GET'])]
    public function index(GarageRepository $garageRepository, LocationRepository $locationRepository,PaginatorInterface $paginator, int $page = 1): Response
    {
        $garages = $garageRepository->findAll();
        $pagination = $paginator->paginate(
            $garages,
            $page,
            10
        );
        foreach ($garages as $garage) {

        }
        return $this->render('Garage/Garage.html.twig', [
            'garages' => $pagination,
        ]);
    }






}