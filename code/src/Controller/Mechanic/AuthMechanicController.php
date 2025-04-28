<?php

namespace App\Controller\Mechanic;

use App\Entity\Mechanic;
use App\Service\FileUploader;
use App\Type\MechanicType;
use App\Service\CRUD\MechanicService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AuthMechanicController extends AbstractController
{
    private MechanicService $mechanicService;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(MechanicService $mechanicService, UserPasswordHasherInterface $passwordHasher)
    {
        $this->mechanicService = $mechanicService;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/mechanic/register', name: 'mechanic_register', methods: ['GET', 'POST'])]
    public function register(Request $request): Response
    {
        $mechanic = new Mechanic();
        $form = $this->createForm(MechanicType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $this->passwordHasher->hashPassword($mechanic, $mechanic->getPassword());
            $mechanic->setPassword($hashedPassword);

            $this->mechanicService->createMechanic($mechanic);

            $this->addFlash('success', 'Mechanic registered successfully!');
            return $this->redirectToRoute('mechanic_login');
        }

        return $this->render('Mechanic/RegisterMechanic.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('/mechanic/login', name: 'mechanic_login', methods: ['GET', 'POST'])]
    public function login(Request $request, SessionInterface $session): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            $mechanic = $this->mechanicService->getMechanicByEmail($email);

            if ($mechanic && $this->passwordHasher->isPasswordValid($mechanic, $password)) {
                // Store mechanic info in session manually
                $session->set('mechanic_id', $mechanic->getId());
                $this->addFlash('success', 'Login successful!');
                return $this->redirectToRoute('app_home'); // or whatever route you want
            }

            $this->addFlash('error', 'Invalid credentials.');
        }

        return $this->render('Mechanic/LoginMechanic.html.twig');
    }
}
