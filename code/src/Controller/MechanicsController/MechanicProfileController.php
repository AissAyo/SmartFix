<?php
namespace App\Controller\MechanicsController;

use App\Repository\GarageRepository;
use App\Repository\MechanicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\NotificationsService;

class MechanicProfileController extends AbstractController
{
    
    public function show(NotificationsService $notifs)
    {
        $notifs->addNotification('you have new message  🔔');
    }
    #[Route('/profile/{id}', name: 'profile_show', methods: ['GET'])]
    public function showProfileMechanic(
        int $id,
        MechanicRepository $mechanicRepository,
        GarageRepository $garageRepository,
        SessionInterface $session // 👈 Injection de la session ici
    ): Response {
        // Récupérer le mécanicien par son ID
        $mechanic = $mechanicRepository->getEntityById($id); // Utilisation de find() pour récupérer l'entité
    
        if (!$mechanic) {
            throw $this->createNotFoundException('Mécanicien non trouvé');
        }
        $session->set('last_mechanic_viewed', $mechanic->getId());
        // $this->addFlash('info', 'Profil du mécanicien affiché.');

    
        // Récupérer les garages associés à ce mécanicien
        // $garages = $garageRepository->findBy(['mechanic' => $mechanic]); // Assurez-vous qu'il y a une relation entre Garage et Mechanic
    
        return $this->render('mechanics/mechanic_profile.html.twig', [
            'mechanic' => $mechanic,
                        // 'last_id' => $lastId, // Si tu veux le passer à la vue pour debug ou affichage
                // 'garages' => $garages,

        ]);
    }
    #[Route('/edit/{id}', name: 'profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Security $security, Mechanic $mechanic): Response
    {
        // 1. Récupérer l'utilisateur connecté (le garagiste)
        $mechanic = $security->getUser(); 

      

        // 3. Créer le formulaire
        $form = $this->createForm(GarageType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'profile updated!');
            return $this->redirectToRoute('profile_show');
           $this->addFlash('info', 'garage edited.');

        }

        // 5. Passer le formulaire à Twig
        return $this->render('Admin/garage/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
