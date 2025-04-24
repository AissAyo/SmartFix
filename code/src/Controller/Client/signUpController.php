<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class signUpController extends AbstractController
{
    #[route(path: '/signUp', name: 'signUp')]
    public function signUp():Response
    {
        return $this->render('SignUp/SignUp.html.twig');
    }
}