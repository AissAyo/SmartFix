<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MechanicAppointmentController extends AbstractController
{
    #[Route('/mechanic/appointment', name: 'app_mechanic_appointment')]
    public function index(): Response
    {
        return $this->render('mechanic_appointment/MechanicIndexGarage.html.twig', [
            'controller_name' => 'MechanicAppointmentController',
        ]);
    }
}
