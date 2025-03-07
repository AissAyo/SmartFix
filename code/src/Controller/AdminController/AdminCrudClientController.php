<?php

declare(strict_types=1);

namespace App\Controller\AdminController;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminCrudClientController extends AbstractController
{
    #[Route('/client', name: 'CrudClient', /*stateless: true*/)]
    
    public function client(): Response
    {
        return $this->render('Admin/Client.html.twig');
    }
}