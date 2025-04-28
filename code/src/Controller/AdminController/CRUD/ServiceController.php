<?php


namespace App\Controller\AdminController\CRUD;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/service')]
class ServiceController extends AbstractController
{
    #[Route('/Services/{page}', name: 'service_index', defaults: ['page' => 1], methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request, int $page): Response
    {
        // Step 1: Get IDs of unique services by name
        $idResults = $em->createQueryBuilder()
            ->select('MIN(s.id) AS id')
            ->from('App\Entity\Service', 's')
            ->groupBy('s.name')
            ->getQuery()
            ->getResult();

        $ids = array_column($idResults, 'id');

        if (empty($ids)) {
            $query = [];
        } else {
            // Step 2: Build query for fetching services and their categories
            $query = $em->createQueryBuilder()
                ->select('s', 'c')
                ->from('App\Entity\Service', 's')
                ->leftJoin('s.categoryService', 'c')
                ->where('s.id IN (:ids)')
                ->setParameter('ids', $ids)
                ->orderBy('s.name', 'ASC')
                ->getQuery();
        }

        // Step 3: Paginate the results
        $pagination = $paginator->paginate(
            $query,               // Doctrine Query or array
            $page,                // Current page number
            10                    // Limit per page
        );

        // Step 4: Render template
        return $this->render('Admin/CRUD/service/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }



    #[Route('/new', name: 'service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

       // dd($service);
        if ($form->isSubmitted() ) {
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('service_index');
        }

        return $this->render('Admin/CRUD/service/new.html.twig', [
            'form' => $form->createView(),
            'service' => $service,
        ]);
    }

    #[Route('/{id}', name: 'service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('Admin/CRUD/service/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id}/edit', name: 'service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('service_index');
        }

        return $this->render('Admin/CRUD/service/edit.html.twig', [
            'form' => $form->createView(),
            'service' => $service,
        ]);
    }

    #[Route('/{id}', name: 'service_delete', methods: ['POST'])]
    public function delete(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $service->getId(), $request->request->get('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('service_index');
    }
}
