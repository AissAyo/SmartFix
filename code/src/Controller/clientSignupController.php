<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use App\DTO\clientSignupDTO;
use App\Form\Type\clientType;

class clientSignupController extends AbstractController
{
    #[Route('/clientSignup', name: 'clientSignup')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $clientSignupDTO = new clientSignupDTO();
        $form = $this->createForm(clientType::class, $clientSignupDTO);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientSignupDTO = $form->getData();

            // Create a new Client entity and set its properties from the DTO
            $client = new Client();
            $client->setName($clientSignupDTO->getName());
            $client->setEmail($clientSignupDTO->getEmail());
            $client->setPassword($clientSignupDTO->getPassword());
            $client->setAddress($clientSignupDTO->getAddress());
            $client->setPhone($clientSignupDTO->getPhone());

            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('clientSignup/clientSignup.html.twig', [
            'signup_form' => $form->createView(),
        ]);
    }
}