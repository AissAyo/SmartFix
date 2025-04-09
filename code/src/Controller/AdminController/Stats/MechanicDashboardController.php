<?php

namespace App\Controller\AdminController\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MechanicDashboardController extends AbstractController
{
    /**
     * @Route("/admin/stats/mechanic", name="mechanic_dashboard")
     */
    public function index()
    {
        // Your controller logic for Mechanics here
        return $this->render('admin/stats/mechanic_dashboard.html.twig');
    }
}
