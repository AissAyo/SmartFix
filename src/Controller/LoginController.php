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
use App\Entity\Admin;
use App\Entity\ClientService;

use App\Service\UserSessionManager;
use App\DTO\LoginDTO;
use App\Form\LoginType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request, EntityManagerInterface $em, UserSessionManager $userSessionManager, AuthenticationUtils $authenticationUtils): Response
    {
        $error = null;
         // Vérifier si l'utilisateur est déjà connecté
         if ($userSessionManager->isLoggedIn()) {
            $userType = $userSessionManager->getUserType();

            if ($userType === 'admin') {
                return $this->redirectToRoute('app_home');
            } elseif ($userType === 'clientService') {
                return $this->redirectToRoute('app_home');
            } elseif ($userType === 'garagiste') {
                return $this->redirectToRoute('app_home');
            } elseif ($userType === 'client') {
                return $this->redirectToRoute('app_home');
            } else {
                
                return $this->redirectToRoute('app_login');
            }
        }

        // Dernière erreur de connexion
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier email saisi
        $lastEmail = $authenticationUtils->getLastUsername();

        
        $loginDTO = new LoginDTO();
        $loginDTO->setEmail($lastEmail);

        // Créer le formulaire
        $form = $this->createForm(LoginType::class, $loginDTO);

      

        //apres validation

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = $data->getEmail();
            $password = $data->getPassword();
            
           // Vérifier l'utilisateur parmi les quatre types
           $user = $em->getRepository('App\Entity\Admin')->findOneBy(['email' => $email])
           ?? $em->getRepository('App\Entity\ClientService')->findOneBy(['email' => $email])
           ?? $em->getRepository('App\Entity\Garagiste')->findOneBy(['email' => $email])
           ?? $em->getRepository('App\Entity\Client')->findOneBy(['email' => $email]);

       if ($user && password_verify($password, $user->getPassword())) {
           // Identifier le type d'utilisateur
           $type = $user instanceof \App\Entity\Admin ? 'admin' :
               ($user instanceof \App\Entity\ClientService ? 'clientService' :
               ($user instanceof \App\Entity\Garagiste ? 'garagiste' : 'client'));


          // Stocker les données dans la session
          $session = $request->getSession();
          $session->set('user', [
              'id' => $user->getId(),
              'email' => $user->getEmail(),
              'type' => $type,
          ]);
          if ($userSessionManager->isLoggedIn()) {
            $userType = $userSessionManager->getUserType();

            if ($userType === 'admin') {
                return $this->redirectToRoute('app_home');
            } elseif ($userType === 'clientService') {
                return $this->redirectToRoute('app_home');
            } elseif ($userType === 'garagiste') {
                return $this->redirectToRoute('app_home');
            } elseif ($userType === 'client') {
                return $this->redirectToRoute('app_home');
            } else {
                
                return $this->redirectToRoute('app_login');
            }
        }
        }else
        {
             // Si aucune correspondance
             $error = 'Email ou mot de passe incorrect.';
        }

       
    }
    return $this->render('login/login.html.twig', [
        'login_form' => $form->createView(),
        'error' => $error,
    ]);
}

}