<?php

namespace App\Controller\AdminController\CRUD;

use App\Entity\Garage;
use App\Form\GarageType;
use App\Repository\GarageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/garage')]
class GarageController extends AbstractController
{
    #[Route('/', name: 'garage_index', methods: ['GET'])]
    public function index(GarageRepository $garageRepository): Response
    {
        return $this->render('Admin/garage/index.html.twig', [
            'garages' => $garageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'garage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $garage = new Garage();
        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($garage);
            $em->flush();

            return $this->redirectToRoute('garage_index');
        }

        return $this->render('Admin/garage/new.html.twig', [
            'garage' => $garage,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'garage_show', methods: ['GET'])]
    public function show(Garage $garage): Response
    {
        return $this->render('admin/garage/show.html.twig', [
            'garage' => $garage,
        ]);
    }

    #[Route('/{id}/edit', name: 'garage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Garage $garage, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('garage_index');
        }

        return $this->render('admin/garage/edit.html.twig', [
            'garage' => $garage,
            'form' => $form->createView(),
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
