<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use App\Entity\Garagiste;
use App\Entity\mechanic;
use App\Entity\ServiceClient;

use App\Service\UserSessionManager;
use App\DTO\LoginDTO;
use App\Form\LoginType;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(
        Request                $request,
        EntityManagerInterface $em,
        UserRepository         $userRepository,
        AuthService     $authService,
        AuthenticationUtils    $authenticationUtils,

        #[Autowire(service: 'monolog.logger.security')] LoggerInterface $securityLogger
    ): Response
    {
        $securityLogger->info("Page de connexion visitée depuis l'IP : " . $request->getClientIp());

        // Vérifier si l'utilisateur est déjà connecté
        if ($authService->isLoggedIn()) {
            $userType = $authService->getUserType();
            $securityLogger->info("Utilisateur déjà connecté en tant que : {$userType}");

            if ($userType === 'ServiceClient') {
                return $this->redirectToRoute('app_home');
            } elseif ($userType === 'client') {
                return $this->redirectToRoute('app_home');
            }
        }
        // Dernière erreur de connexion
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier email saisi
        $lastEmail = $authenticationUtils->getLastUsername();

        // Créer le formulaire
        $loginDTO = new LoginDTO();
        $loginDTO->setEmail($lastEmail);
        $form = $this->createForm(LoginType::class, $loginDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data->getEmail();
            $password = $data->getPassword();

            $user = $authService->authenticate($email, $password);

            if ($user === null) {
                $securityLogger->warning("Failed login attempt for email: {$email} from IP: " . $request->getClientIp());

                $this->addFlash('error', 'Incorrect email or password.');
            } else {
                $authService->LoginUser($user);
                $securityLogger->info("Successful login for email: {$email} (Type: " . get_class($user) . ") from IP: " . $request->getClientIp());

                // Redirect based on user type (kept intact)
                if ($authService->isLoggedIn()) {
                    $userType = $authService->getUserType();

                    if ($userType === 'client') {
                        return $this->redirectToRoute('app_home');
                    } elseif ($userType === 'ServiceClient') {
                        return $this->redirectToRoute('app_home');
                    } else {
                        return $this->redirectToRoute('app_login');
                    }
                }
            }

        }

        return $this->render('login/login.html.twig', [
            'login_form' => $form->createView(),
            'error' => $error,
        ]);
    }
}