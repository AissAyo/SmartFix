<?php
namespace App\Controller\AdminController\CRUD;

use App\Entity\Client;
use App\Type\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;

class AdminCrudClientController extends AbstractController
{
#[Route('listclients', name: 'listclient', methods: ['GET'])]
public function index(EntityManagerInterface $entityManager): Response
{
$clients = $entityManager->getRepository(Client::class)->findAll();

// Format the dateInscription for each client
foreach ($clients as $client) {
$client->formattedDate = $client->getDateInscription()->format('Y-m-d H:i:s');
}

return $this->render('Admin/CRUD/Client/adminCrudClient.html.twig', [
'clients' => $clients,
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

#[Route('/admin/clients/{id}/edit', name: 'admin_clients_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
{
$form = $this->createForm(ClientType::class, $client);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$entityManager->flush();

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
