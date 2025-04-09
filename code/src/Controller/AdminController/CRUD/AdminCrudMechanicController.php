<?php
namespace App\Controller\AdminController\CRUD;

use App\Entity\Mechanic;
use App\Service\CRUD\MechanicService;
use App\Type\MechanicType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class AdminCrudMechanicController extends AbstractController
{
    private MechanicService $mechanicService;

    public function __construct(MechanicService $mechanicService)
    {
        $this->mechanicService = $mechanicService;
    }

    #[Route('listmechanic/{page}', name: 'admin_list_mechanic', defaults: ['page' => 1])]
    public function listMechanic(int $page, PaginatorInterface $paginator): Response
    {
        $query = $this->mechanicService->getAllMechanicsQuery();

        $pagination = $paginator->paginate(
            $query,
            $page,
            10 // Items per page
        );

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanic.html.twig', [
            'pagination' => $pagination,
            'mechanics' => $pagination->getItems(),
        ]);
    }

    #[Route('addmechanic', name: 'admin_mechanics_add', methods: ['GET', 'POST'])]
    public function addMechanic(Request $request): Response
    {
        $mechanic = new Mechanic();
        $form = $this->createForm(MechanicType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->mechanicService->createMechanic($mechanic);
                $this->addFlash('success', 'Mechanic created successfully!');
                return $this->redirectToRoute('admin_list_mechanic');
            } else {
                // Handle form errors
                $errors = $form->getErrors(true);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
        }

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicAdd.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/editmechanic/{id}', name: 'admin_mechanics_edit', methods: ['GET', 'POST'])]
    public function editMechanic(Request $request, int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);
        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }

        $form = $this->createForm(MechanicType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->mechanicService->updateMechanic($mechanic);
            return $this->redirectToRoute('admin_list_mechanic');
        }

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('showmechanic/{id}', name: 'admin_mechanics_show', methods: ['GET'])]
    public function showMechanic(int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);
        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicShow.html.twig', ['mechanic' => $mechanic]);
    }

    #[Route('deletemechanic/{id}', name: 'admin_mechanics_delete', methods: ['POST'])]
    public function deleteMechanic(Request $request, int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);
        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }

        if ($this->isCsrfTokenValid('delete' . $mechanic->getId(), $request->request->get('_token'))) {
            $this->mechanicService->deleteMechanic($mechanic);
            $this->addFlash('success', 'Mechanic deleted successfully!');
        }

        return $this->redirectToRoute('admin_list_mechanic');
    }
}
