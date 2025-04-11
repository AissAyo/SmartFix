<?php
namespace App\Controller\Mechanics;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MechanicsCrudController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/reservation', name: 'manage_reservations')]
    public function reserv(Request $request): Response
    {
        // Récupérer toutes les réservations
        $reservations = $this->entityManager
            ->getRepository(Reservation::class)
            ->findAll();

        return $this->render('page/mechanics/reservation.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reservation/add', name: 'add_reservation')]
    public function addReservation(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();

            // Redirige vers la page de gestion des réservations après ajout
            return $this->redirectToRoute('manage_reservations');
        }

        return $this->render('page/mechanics/add_reservation.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Autres actions comme accept, edit, delete ici...
}
