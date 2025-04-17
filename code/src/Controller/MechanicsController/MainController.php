<?php

namespace App\Controller\MechanicsController;

use App\Entity\Reservation;
use App\Form\AddReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    
    #[Route('/mechanic', name: 'mechanic')]
    public function main(): Response
    {
        return $this->render('mechanics/main.html.twig');
    }

    #[Route('/mechanic/garage', name: 'garage')]
    public function garage(): Response
    {
        return $this->render('mechanics/garage.html.twig');
    }

}
