<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Service\AuthClientService;
use App\Service\ClientService;
use App\Service\CRUD\ClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthClientController extends AbstractController
{
    #[Route('/register/client', name: 'app_register_client')]
    public function register(
        Request $request,
        AuthClientService $authClientService,
        ClientService $clientService
    ): Response {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($clientService->existsByEmail($client->getEmail())) {
                $this->addFlash('error', 'Email already registered.');
            } else {
                $authClientService->sendVerificationCode($client->getPhone());
                $clientService->save($client);

                $this->addFlash('success', 'Verification code sent to your phone.');
                return $this->redirectToRoute('app_verify_code', ['id' => $client->getId()]);
            }
        }

        return $this->render('auth/register_client.html.twig', [
            'signup_form' => $form->createView(),
        ]);
    }

    #[Route('/verify-code/{id}', name: 'app_verify_code')]
    public function verifyCode(
        Request $request,
        Client $client,
        AuthClientService $authClientService,
        ClientService $clientService
    ): Response {
        $code = $request->request->get('verification_code');

        if ($code && $authClientService->verifyCode($client->getPhone(), $code)) {
            $client->setVerified(true);
            $clientService->update($client);

            $this->addFlash('success', 'Phone number verified successfully!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('auth/verify_code.html.twig', [
            'client' => $client,
        ]);
    }
}
