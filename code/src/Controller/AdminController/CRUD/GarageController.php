<?php
namespace App\Controller\AdminController\CRUD;

use App\Entity\Garage;
use APP\Entity\Mechanic;
use App\Form\GarageType;
use App\Repository\GarageRepository;
use App\Repository\MechanicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GarageController extends AbstractController
{
    #[Route('/garage/{id}', name: 'garage_show', methods: ['GET'])]
    public function showGaragesByMechanic(
        int $id,
        GarageRepository $garageRepository,
        MechanicRepository $mechanicRepository
    ): Response {
        // Récupérer le mécanicien par son ID
        $mechanic = $mechanicRepository->getEntityById($id);
    
        if (!$mechanic) {
            throw $this->createNotFoundException('Mécanicien non trouvé');
        }
    
        // Récupérer les garages associés à ce mécanicien
        $garages = $garageRepository->getGaragesByMechanic($mechanic);
    
        return $this->render('mechanics/main.html.twig', [
            'garages' => $garages,
            'mechanic' => $mechanic,
        ]);
    }
    

    #[Route('/new/{id}', name: 'garage_new', methods: ['GET', 'POST'])]
    public function new(int $id, Request $request, EntityManagerInterface $em, GarageRepository $garageRepository, MechanicRepository $mechanicRepository): Response
    {
        // Utilisation de la méthode correcte du repository pour récupérer le mécanicien par son ID
        $mechanic = $mechanicRepository->getEntityById($id);
    
        // Crée l'objet Garage
        $garage = new Garage();
    
        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
            $errors = $form->getErrors(true);  // Le paramètre true permet de récupérer les erreurs imbriquées
            foreach ($errors as $error) {

                if (strpos($error->getMessage(), 'reservations') !== false) {

                    // Ignorer l'erreur
                    continue;
                }
    
                // Tu peux aussi logguer ou afficher d'autres erreurs si nécessaire
                // Par exemple : $this->addFlash('error', $error->getMessage());
            }
    
            // Si le formulaire est valide (après avoir ignoré l'erreur liée à 'reservations')
            if ($form->isValid()) {

                $em->persist($garage);  // Persiste l'objet Garage
                $em->flush();  // Sauvegarde dans la base de données
                return $this->redirectToRoute('garage_index');  // Redirige vers une autre route après la réussite
            }
        }
    
        // Rendu du formulaire dans la vue
        return $this->render('mechanics/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    


    // #[Route('/{id}', name: 'garage_show', methods: ['GET'])]
    // public function show(Garage $garage): Response
    // {
    //     return $this->render('admin/garage/show.html.twig', [
    //         'garage' => $garage,
    //     ]);
    // }

    #[Route('/edit/{id}', name: 'garage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Security $security, Garage $garage): Response
    {
        // 1. Récupérer l'utilisateur connecté (le garagiste)
        $mechanic = $security->getUser(); 

        // 2. Vérifier que le garage appartient bien au garagiste connecté
        if ($garage->getMechanic() !== $mechanic) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à modifier ce garage.');
        }

        // 3. Créer le formulaire
        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        // 4. Si le formulaire est soumis et valide, on enregistre les changements
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Garage updated!');
            return $this->redirectToRoute('garage_index');
        }

        // 5. Passer le formulaire à Twig
        return $this->render('Admin/garage/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'garage_delete', methods: ['POST'])]
    public function delete(Request $request, Garage $garage, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $garage->getId(), $request->request->get('_token'))) {
            $em->remove($garage);
            $em->flush();
        }

        return $this->redirectToRoute('garage_index');
    }
    #[Route('/main', name: 'main', methods: ['GET'])]
public function main(): Response
{
    return $this->render('mechanics/main.html.twig');
}

}
