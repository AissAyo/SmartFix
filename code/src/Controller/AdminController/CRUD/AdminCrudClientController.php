<?php
namespace App\Controller\AdminController\CRUD;

use App\Entity\Client;
use App\Type\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class AdminCrudClientController extends AbstractController
{
    #[Route('/listclients/{page}', name: 'list_clients', methods: ['GET', 'POST'])]
    public function index(EntityManagerInterface $entityManager, int $page=1, PaginatorInterface $paginator): Response
    {
        $client = $entityManager->getRepository(Client::class)
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC');  // Default sorting
        $pagination = $paginator->paginate(
            $client,
            $page,  // Automatically takes from URL (e.g., `/listclients/2`)
            10      // Items per page
        );

        // Format dates
        foreach ($pagination as $client) {
            $client->formattedDate = $client->getDateInscription()->format('Y-m-d H:i:s');
        }

        return $this->render('Admin/CRUD/Client/adminCrudClient.html.twig', [
            'pagination' => $pagination,
        ]);
    }

#[Route('/admin/clients/{id}', name: 'app_admin_crud_client_show', methods: ['GET'])]
public function show(Client $client): Response
{
return $this->render('Admin/CRUD/show.html.twig', [
'client' => $client,
]);
}

    #[Route('/adminAddClient', name: 'admin_clients_add', methods: ['GET', 'POST'])]
    public function new(Request $request, FileUploader $fileUploader, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get and hash the password
            $plainPassword = $form->get('password')->getData(); // Adjust if the form field name is different
            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword($client, $plainPassword);
                $client->setPassword($hashedPassword);
            }

            // Handle file upload for profile photo
            $photoProfil = $form->get('ClientphotoProfilFile')->getData();
            if ($photoProfil) {
                $clientPhotoProfilFile = $fileUploader->upload($photoProfil);
                $client->setPhotoProfil($clientPhotoProfilFile);
            }

            // Persist the client entity
            $entityManager->persist($client);
            $entityManager->flush();

            // Set the last page to 1 or get the actual last page if needed
            $lastPage = 1; // Set to 1 for now or retrieve it dynamically if necessary

            // Redirect to the client list page after successful creation
            return $this->redirectToRoute('listclients', ['page' => $lastPage]);
        }

        return $this->render('Admin/CRUD/Client/adminAddClient.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

#[Route('/adminEditClient/{id}', name: 'admin_clients_edit', methods: ['GET', 'POST'])]
public function edit(int $id, Request $request, FileUploader $fileUploader, EntityManagerInterface $entityManager): Response
{
    // Find the client by its ID
    $client = $entityManager->getRepository(Client::class)->find($id);
    if (!$client) {
        throw $this->createNotFoundException('No client found for id ' . $id);
    }

    // Create the form and bind it to the existing client data
    $form = $this->createForm(ClientType::class, $client);
    $form->handleRequest($request);

    if ($form->isSubmitted() ) {
        // Handle file upload for the profile photo
        $photoProfil = $form->get('ClientphotoProfilFile')->getData();
        //dd($photoProfil);
        if ($photoProfil) {

            $clientPhotoProfilFile = $fileUploader->upload($photoProfil);
            $client->setPhotoProfil($clientPhotoProfilFile);
        }

        // Persist the updated client entity
        $entityManager->persist($client);
        $entityManager->flush();
        // Log the last page to debug


        $lastPage =1;
        $this->get('logger')->info('Last page: ' . $lastPage);

        // Redirect to the list of clients after successful update
        return $this->redirectToRoute('listclients', ['page' => $lastPage]);
    }

    return $this->render('Admin/CRUD/Client/adminEditClient.html.twig', [
        'client' => $client,
        'form' => $form->createView(),
    ]);
}

    #[Route('/admin/clients/{id}/delete', name: 'admin_clients_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
            $entityManager->remove($client);
            $entityManager->flush();
        }

        // Get the last page from session, defaulting to 1 if it's not set
        $lastPage = $session->get('last_page', 1);

        // Redirect to the last page
        return $this->redirectToRoute('listclients', ['page' => $lastPage]);
    }
}
