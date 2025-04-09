<?php

namespace App\Controller\AdminController\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClientDashboardController extends AbstractController
{
    /**
     * @Route("/admin/stats/client", name="client_dashboard")
     */
    public function index()
    {
        // Your controller logic here
        return $this->render('admin/stats/client_dashboard.html.twig');
    }
}
