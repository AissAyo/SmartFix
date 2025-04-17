<?php

namespace App\Controller\AdminController\CRUD;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CarType;
class CarController extends AbstractController
{


    #[Route('admincars/{page}', name: 'listclient', defaults: ['page' => 1], methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, int $page, PaginatorInterface $paginator): Response
    {
        $car = $entityManager->getRepository(vehicule::class)
            ->createQueryBuilder('c')
            ->orderBy('c.brand', 'ASC');  // Default sorting
        $pagination = $paginator->paginate(
            $car,
            $page,  // Automatically takes from URL (e.g., `/listclients/2`)
            10      // Items per page
        );



        return $this->render('Admin/CRUD/Car/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
    #[Route('/new', name: 'admin_cars_add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $car = new Vehicule();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('admin_cars_index');
        }

        return $this->render('Admin/CRUD/Car/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicule $car, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('admin_cars_index');
        }

        return $this->render('Admin/CRUD/Car/edit.html.twig', [
            'form' => $form->createView(),
            'car' => $car,
        ]);
    }

    #[Route('/{id}', name: 'admin_car_delete', methods: ['POST'])]
    public function delete(Request $request, Vehicule $car, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $em->remove($car);
            $em->flush();
        }

        return $this->redirectToRoute('admin_cars_index');
    }




}