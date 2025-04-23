<?php

namespace App\Controller\AdminController\CRUD;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\CarAPI;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CarType;
class CarController extends AbstractController
{

//    private  CarApi $carApi;
//    public function __construct(  CarApi $carApi)
//    {
//        $this->carApi = $carApi;
//    }
    #[Route('admincars/{page}', name: 'list_cars', defaults: ['page' => 1], methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, int $page, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $entityManager->getRepository(CarAPI::class)
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC');

        $pagination = $paginator->paginate(
            $queryBuilder, // The query builder
            $page,         // Current page
            10             // Items per page
        );

        return $this->render('Admin/CRUD/Car/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }





}