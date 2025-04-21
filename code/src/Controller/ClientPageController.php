<?php   

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientPageController extends AbstractController
{
    
    #[Route('/client', name: 'client_page')]
    public function index(): Response
    {
        return $this->render('Client/ClientPage.html.twig');
    }
}