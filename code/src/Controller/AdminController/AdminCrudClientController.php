<?php
<<<<<<< HEAD
namespace App\Controller\AdminController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCrudClientController extends AbstractController
{
    // Your code here
=======

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
>>>>>>> b5f74be67730947e6fc0467d1ad111ea928ffcf3
}