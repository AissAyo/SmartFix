<?php

namespace App\Controller\AdminController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Doctrine\ORM\EntityManagerInterface;
use app\Entity\Admin;
use App\Repository\AdminRepository;
use App\Service\UserSessionManager;
use App\Service\AuthService;
use App\DTO\LoginDTO;
use App\Form\LoginType;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminLoginController extends AbstractController 
{
    #[Route('/admin/login', name: 'admin_login', methods: ['GET', 'POST'])]
    public function login(
        Request                $request,
        EntityManagerInterface $em,
        AdminRepository        $adminRepository,
        AuthService            $authService,
        AuthenticationUtils    $authenticationUtils,
        #[Autowire(service: 'monolog.logger.security')] LoggerInterface $securityLogger
    ):response
    {
        $securityLogger->info("Page de connexion visitée depuis l'IP : " . $request->getClientIp());
        if ($authService->isLoggedIn()) {
            $userType = $authService->getUserType();
            $securityLogger->info("Utilisateur déjà connecté en tant que : {$userType}");
            if ($userType === 'Admin') {
                return $this->redirectToRoute('admin_home');
            }
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastEmail = $authenticationUtils->getLastUsername();
        $loginDTO = new LoginDTO();
        $loginDTO->setEmail($lastEmail);
        $form = $this->createForm(LoginType::class, $loginDTO);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $loginDTO = $form->getData();
            $admin = $adminRepository->findOneBy(['email' => $loginDTO->getEmail()]);
            if ($admin && password_verify($loginDTO->getPassword(), $admin->getPassword())) {
                $authService->login($admin, 'Admin');
                return $this->redirectToRoute('admin_home');
            }
            $this->addFlash('error', 'Email ou mot de passe incorrect');
        }
        return $this->render('admin/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    
    }
} 