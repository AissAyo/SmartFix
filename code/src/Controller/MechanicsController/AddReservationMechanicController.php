<?php
// src/Controller/AddReservationController.php

namespace App\Controller\MechanicsController;

use App\Entity\Reservation;
use App\Form\AddReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;


class AddReservationMechanicController extends AbstractController
{
    #[Route('/mechanic/reservation/add', name: 'mechanic_reservation_add', methods: ['GET', 'POST'])]
    public function addAsMechanic(Request $request, EntityManagerInterface $em): Response
{
    $reservation = new Reservation();

    $form = $this->createForm(AddReservationType::class, $reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Si aucune date définie, on set la date actuelle
        if ($reservation->getReservationDate() === null) {
            $reservation->setReservationDate(new \DateTime());
        }

        // Paramètres par défaut
        $reservation->setStatus('pending');
        $reservation->setEstimatedPrice('0.00');

        // Juste au cas où le client existe
        if ($reservation->getClient()) {
            $reservation->setClientId($reservation->getClient()->getId());
        }

        $em->persist($reservation);
        $em->flush();

        $this->addFlash('success', 'Reservation successfully added!');

        return $this->redirectToRoute('mechanic_reservation_add'); // tu peux rediriger ailleurs si tu veux
    }

    return $this->render('mechanics/new.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
