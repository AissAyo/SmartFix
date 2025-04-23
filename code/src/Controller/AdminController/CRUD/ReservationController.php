<?php

namespace App\Controller\AdminController\CRUD;

use App\Entity\Client;
use App\Entity\Reservation;
use App\Entity\Service;
use App\Entity\Vehicule;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation')]  // This prefix will be applied to all routes in the controller
class ReservationController extends AbstractController
{
    #[Route('/', name: 'admin_reservation_index', methods: ['GET'])]
    public function index(
        ReservationRepository $reservationRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $query = $reservationRepository->getReservationDetails();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('Admin/CRUD/reservation/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'admin_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();
        $service= new service();
        $client= new client();
        $vehicule= new vehicule();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Admin/CRUD/reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add', name: 'admin_reservation_show', methods: ['GET'])]
    public function add(): Response
    {
        return $this->render('Admin/CRUD/reservation/new.html.twig', []);
    }

    #[Route('/{id}/edit', name: 'admin_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Reservation $reservation,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Admin/CRUD/reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'admin_reservation_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Reservation $reservation,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}