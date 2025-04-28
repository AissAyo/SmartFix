<?php
namespace App\Controller;

use App\Entity\Client;
use App\Service\AuthClient\WhatsAppVerificationCodeSender;
use App\Service\CRUD\ClientService;
use App\Type\clientauthType;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthClientController extends AbstractController
{
    #[Route('/register/client', name: 'app_register_client')]
    // src/Controller/AuthClientController.php

    public function register(Request $request, ClientService $clientService, WhatsAppVerificationCodeSender $verificationService): Response
    {
        $client = new Client();
        $form = $this->createForm(clientauthType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Validate uniqueness first
                if ($clientService->existsByEmail($client->getEmail())) {
                    $this->addFlash('error', 'Email already registered.');
                    return $this->redirectToRoute('app_register_client');
                }

                if ($clientService->phoneExists($client->getPhone())) {
                    $this->addFlash('error', 'Phone number already registered.');
                    return $this->redirectToRoute('app_register_client');
                }

                // Temporary save to get ID
                $clientService->saveClient($client);

                if (!$verificationService->sendVerificationCode($client->getPhone())) {
                    throw new \RuntimeException('Failed to send verification code. Please try again later.');
                }

                $this->addFlash('success', 'Verification code sent to your WhatsApp!');
                return $this->redirectToRoute('app_verify_code', ['id' => $client->getId()]);

            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('Auth/register_client.html.twig', [
            'signup_form' => $form->createView(),
        ]);
    }

    #[Route('/verify-code/{id}', name: 'app_verify_code')]
    public function verifyCode(
        Request $request,
        Client $client,
        WhatsAppVerificationCodeSender $verificationService,
        ClientService $clientService,
        LoggerInterface $logger
    ): Response {
        $code = $request->request->get('verification_code');

        if ($code) {
            try {
                if ($verificationService->verifyCode($client->getPhone(), $code)) {
                    $client->setVerificationStatus(true);
                    $clientService->saveClient($client);

                    $logger->info('Client verified successfully', [
                        'client_id' => $client->getId()
                    ]);

                    $this->addFlash('success', 'Phone number verified successfully!');
                    return $this->redirectToRoute('app_home');
                }

                $this->addFlash('error', 'Invalid verification code. Please try again.');
            } catch (\Exception $e) {
                $logger->error('Verification failed', [
                    'client_id' => $client->getId(),
                    'error' => $e->getMessage()
                ]);
                $this->addFlash('error', 'Verification failed: ' . $e->getMessage());
            }
        }

        return $this->render('Auth/verify_code.html.twig', [
            'client' => $client,
            'error' => $request->query->get('error')
        ]);
    }
}