<?php

namespace App\Controller\AdminController;

use App\Entity\Mechanic;
use App\Service\MechanicService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCrudMechanicController extends AbstractController
{
    private MechanicService $mechanicService;

    public function __construct(MechanicService $mechanicService)
    {
        $this->mechanicService = $mechanicService;
    }

    #[Route('/admin/mechanics', name: 'admin_mechanics_list', methods: ['GET'])]
    public function list(): Response
    {
        $mechanics = $this->mechanicService->getAllMechanics();
        return $this->render('admin/mechanics/list.html.twig', ['mechanics' => $mechanics]);
    }

    #[Route('/admin/mechanics/{id}', name: 'admin_mechanics_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);
        if (!$mechanic) {
            throw $this->createNotFoundException('Mechanic not found');
        }
        return $this->render('admin/mechanics/show.html.twig', ['mechanic' => $mechanic]);
    }

    #[Route('/admin/mechanics/new', name: 'admin_mechanics_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $mechanic = new Mechanic();
            // Set properties from request
            $this->mechanicService->createMechanic($mechanic);
            return $this->redirectToRoute('admin_mechanics_list');
        }
        return $this->render('admin/mechanics/new.html.twig');
    }

    #[Route('/admin/mechanics/{id}/edit', name: 'admin_mechanics_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);
        if (!$mechanic) {
            throw $this->createNotFoundException('Mechanic not found');
        }
        if ($request->isMethod('POST')) {
            // Update properties from request
            $this->mechanicService->updateMechanic($mechanic);
            return $this->redirectToRoute('admin_mechanics_list');
        }
        return $this->render('admin/mechanics/edit.html.twig', ['mechanic' => $mechanic]);
    }

    #[Route('/admin/mechanics/{id}/delete', name: 'admin_mechanics_delete', methods: ['POST'])]
    public function delete(int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);
        if (!$mechanic) {
            throw $this->createNotFoundException('Mechanic not found');
        }
        $this->mechanicService->deleteMechanic($mechanic);
        return $this->redirectToRoute('admin_mechanics_list');
    }
}