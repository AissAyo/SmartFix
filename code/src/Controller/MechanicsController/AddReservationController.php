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

class AddReservationController extends AbstractController
{
    
    #[Route('/reservation/add', name: 'reservation_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $reservation = new Reservation();

        $form = $this->createForm(AddReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si la date de réservation est vide, on évite une erreur
            if ($reservation->getReservationDate() === null) {
                $reservation->setReservationDate(new \DateTime());
            }

            // Valeurs par défaut si besoin
            $reservation->setStatus('en attente');
            $reservation->setEstimatedPrice('0.00'); // à ajuster selon ta logique
            $reservation->setClientId($reservation->getClient()->getId());

            $em->persist($reservation);
            $em->flush();

            $this->addFlash('success', 'Réservation ajoutée avec succès !');

            return $this->redirectToRoute('reservation_add'); // ou vers une autre route
        }

        return $this->render('mechanics/Add_Reservation.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
