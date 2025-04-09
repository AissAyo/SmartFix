<?php

namespace App\Controller\AdminController\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SellerDashboardController extends AbstractController
{
    /**
     * @Route("/admin/stats/seller", name="seller_dashboard")
     */
    public function index()
    {
        // Your controller logic for Sellers here
        return $this->render('admin/stats/seller_dashboard.html.twig');
    }
}
