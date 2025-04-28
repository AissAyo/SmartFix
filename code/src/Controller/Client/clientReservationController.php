<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class clientReservationController extends abstractController
{
    #[route('/myreservations', name: 'myreservations', methods: ['GET'])]
    public function getMyResrvation():response
    {
        return $this->render('Client/myreservation.html.twig');
    }
}