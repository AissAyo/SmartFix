<?php

namespace App\Controller\Client;

use App\Entity\Client;
use App\Service\FileUploader;
use App\Type\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class signUpController extends AbstractController
{
    #[route(path: '/signUp', name: 'signUp')]
    public function signUp(Request $request, FileUploader $fileUploader, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher):Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        $plainPassword = $form->get('password')->getData(); // Adjust if the form field name is different

        if ($form->isSubmitted() && $form->isValid()) {
            // Get and hash the password
            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword($client, $plainPassword);
                $client->setPassword($hashedPassword);
            }

            // Handle file upload for profile photo
            $photoProfilFile = $form->get('photoProfilFile')->getData();

            if (!$photoProfilFile) {
                $this->addFlash('error', 'No file was uploaded.');
                return $this->redirectToRoute('admin_mechanics_add');
            }

            if (!$photoProfilFile instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                $this->addFlash('error', 'Invalid file upload.');
                return $this->redirectToRoute('admin_mechanics_add');
            }

            if ($photoProfilFile) {
                $client->setPhotoProfilFile($photoProfilFile); // VichUploader will handle the upload
            }

            // Persist the client entity
            $entityManager->persist($client);
            $entityManager->flush();

            // Set the last page to 1 or get the actual last page if needed
          // Set to 1 for now or retrieve it dynamically if necessary

            // Redirect to the client list page after successful creation
            return $this->redirectToRoute('listclients', ['page' => $lastPage]);
        }


        return $this->render('SignUp/SignUp.html.twig',[
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }
}