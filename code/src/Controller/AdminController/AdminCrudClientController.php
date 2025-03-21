<?php

declare(strict_types=1);

namespace App\Controller\AdminController;
use App\Service\NormalClientService;  // Import du service
use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminCrudClientController extends AbstractController
{
    #[Route('/client', name: 'CrudClient', /*stateless: true*/)]
    
    public function client(): Response
    {
        return $this->render('Admin/Client.html.twig');
    }
    #[Route('/verified', name: 'admin_add_verified_client')]
    public function addVerifiedClient()
    {
        return $this->render('Admin/AddVerifiedClient.html.twig');
    }

    #[Route('/normal', name: 'admin_add_normal_client')]
    public function addNormalClient()
    {
        return $this->render('Admin/AddNormalClient.html.twig');
    }
    


    private NormalClientService $normalClientService;

    public function __construct(NormalClientService $normalClientService)
    {
        $this->normalClientService = $normalClientService;
    }

    #[Route('/ADDClient', name: 'AddNormalClient', methods: ['POST'])]    
    public function addClient(Request $request): Response
    {

        // Traitement du formulaire d'ajout
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $address = $request->request->get('address');
            $plainPassword = $request->request->get('password');

            try {
                // Appeler la méthode du service pour ajouter le client
                $this->normalClientService->addClient($username, $name, $email, $address, $plainPassword);
                // Redirection après succès
                return $this->redirectToRoute('client_success');
            } catch (\Exception $e) {
                // Gérer les erreurs (email déjà pris, etc.)
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('Admin/AddNormalClient.html.twig');
    }
}








    
