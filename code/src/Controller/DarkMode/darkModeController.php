<?php

namespace App\Controller\DarkMode;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class darkModeController extends AbstractController
{
    #[Route(path: '/darkMode', name: 'darkMode')]
    public function darkMode(): Response
    {
        return $this->render('darkMode/darkMode.html.twig');
    }
}