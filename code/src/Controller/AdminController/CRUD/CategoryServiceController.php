<?php
namespace App\Controller\AdminController\CRUD;

use App\Entity\CategoryService;
use App\Form\CategoryServiceType;
use App\Repository\CategoryServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryServiceController extends AbstractController
{
    #[Route('/categoryservic/{page}', name: 'category_service_index', defaults: ['page' => 1], methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, CategoryServiceRepository $categoryServiceRepository, int $page, PaginatorInterface $paginator): Response
    {
        $query = $entityManager->getRepository(CategoryService::class)
            ->createQueryBuilder('c')
            ->orderBy('c.Categoryname', 'ASC');

        $pagination = $paginator->paginate(
            $query,
            $page,
            10
        );

        return $this->render('Admin/CRUD/category_service/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }


    #[Route('/new', name: 'category_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoryService = new CategoryService();
        $form = $this->createForm(CategoryServiceType::class, $categoryService);
        $form->add('save', SubmitType::class, ['label' => 'Create Category Service']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoryService);
            $entityManager->flush();

            return $this->redirectToRoute('category_service_index');
        }

        return $this->render('Admin/CRUD/category_service/new.html.twig', [
            'category_service' => $categoryService,
            'form' => $form->createView(),
        ]);
    }



    #[Route('/{id}/edit', name: 'category_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoryService $categoryService, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryServiceType::class, $categoryService);
        $form->add('save', SubmitType::class, ['label' => 'Edit Category Service']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('category_service_index');
        }

        return $this->render('Admin/CRUD/category_service/edit.html.twig', [
            'category_service' => $categoryService,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'category_service_delete', methods: ['DELETE'])]
    public function delete(Request $request, CategoryService $categoryService, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryService->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoryService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_service_index');
    }
}