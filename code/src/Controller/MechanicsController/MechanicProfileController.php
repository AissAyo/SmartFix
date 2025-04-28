<?php
namespace App\Controller\MechanicsController;

use App\Repository\GarageRepository;
use App\Repository\MechanicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\GarageType;
use App\Type\MechanicType;



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
   
    #[Route('/edit/{id}', name: 'mechanic_edit', methods: ['GET', 'POST'])]
public function edit(
    Request $request,
    EntityManagerInterface $em,
    MechanicRepository $mechanicRepository,
    int $id
): Response {
    // Récupérer l'entité Mechanic par l'ID
    $mechanic = $mechanicRepository->getEntityById($id);

    if (!$mechanic) {
        throw $this->createNotFoundException('Mécanicien non trouvé');
    }

    // Créer le formulaire avec l'entité Mechanic
    $form = $this->createForm(MechanicType::class, $mechanic);
    $form->handleRequest($request);

    // Si le formulaire est soumis et valide, enregistrer les données
    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();  // Sauvegarder les modifications dans la base de données
        $this->addFlash('success', 'Profile updated!');
        return $this->redirectToRoute('profile_show', ['id' => $id]);  // Redirection après mise à jour
    }

    // Passer l'entité mechanic et le formulaire à Twig
    return $this->render('mechanics/Edit_Profile.html.twig', [
        'form' => $form->createView(),
        'mechanic' => $mechanic,  // Ajouter la variable mechanic ici
    ]);
}
}