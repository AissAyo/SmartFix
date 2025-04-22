<?php

namespace App\Controller\AdminController\login;

use App\Controller\AdminController\Autowire;
use App\Entity\Admin;
use App\Type\AdminAuthType;
use App\Form\LoginType;
use App\Service\authAdmin\authAdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminLoginController extends AbstractController
{
    private authAdminService $authAdminService;

    public function __construct(authAdminService $authAdminService)
    {
        $this->authAdminService = $authAdminService;
    }

    #[Route('/adminlogin', name: 'app_Admin_login', methods: ['GET', 'POST'])]
    public function login(Request $request ,AuthenticationUtils $authenticationUtils): Response
    {
        $session = $request->getSession();
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            if ($this->authAdminService->login($email, $password)) {
                return $this->redirectToRoute('admin_login');
            }

            $this->addFlash('error', 'Invalid credentials');
        }

        return $this->render('admin/login.html.twig');
    }

    #[Route('/admin/login', name: 'admin_login', methods: ['GET', 'POST'])]
    public function loginpage(): Response
    {
        $form = $this->createForm(AdminAuthType::class);
        return $this->render('Admin/Login/adminlogin.html.twig',[
            'form' => $form->createView(),]);
    }
    #[Route('/navbar', name: 'nav_bar', methods: ['GET', 'POST'])]
    public function navbar()
    {
        return $this->render('navtest.html.twig');
    }

}