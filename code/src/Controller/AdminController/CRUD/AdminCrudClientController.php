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

class AdminCrudClientController extends AbstractController
{
    #[Route('listclients/{page}', name: 'listclient', defaults: ['page' => 1], methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, int $page, PaginatorInterface $paginator): Response
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
public function new(Request $request, FileUploader $fileUploader, EntityManagerInterface $entityManager): Response
{
$client = new Client();

$form = $this->createForm(ClientType::class, $client);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$photoProfil = $form->get('ClientphotoProfilFile')->getData();
if ($photoProfil) {
$clientPhotoProfilFile = $fileUploader->upload($photoProfil);
$client->setPhotoProfil($clientPhotoProfilFile);
}

$entityManager->persist($client);
$entityManager->flush();

return $this->redirectToRoute('listclient');
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

        // Redirect to the list of clients after successful update
        return $this->redirectToRoute('listclient');
    }

    return $this->render('Admin/CRUD/Client/adminEditClient.html.twig', [
        'client' => $client,
        'form' => $form->createView(),
    ]);
}

#[Route('/admin/clients/{id}/delete', name: 'admin_clients_delete', methods: ['POST'])]
public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
{
if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
$entityManager->remove($client);
$entityManager->flush();
}

return $this->redirectToRoute('listclient');
}
}
