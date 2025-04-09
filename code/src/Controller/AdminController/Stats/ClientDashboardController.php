<?php

namespace App\Controller\AdminController\Stats;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClientDashboardController extends AbstractController
{
    /**
     * @Route("/admin/stats/client", name="client_dashboard")
     */
    public function index(ClientRepository $clientRepository)
    {
        // Your controller logic here
        return $this->render('admin/stats/client_dashboard.html.twig');
    }
}
