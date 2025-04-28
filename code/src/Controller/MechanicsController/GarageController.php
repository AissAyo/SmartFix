<?php
namespace App\Controller\MechanicsController;

use App\Entity\Garage;
use App\Form\GarageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GarageRepository; 
use App\Repository\MechanicRepository;

class GarageController extends AbstractController
{
    #[Route('/garage/{id}', name: 'garage_show', methods: ['GET'])]
    public function showProfileMechanic(
        int $id,
        MechanicRepository $mechanicRepository,
        GarageRepository $garageRepository
    ): Response {
        // Récupérer le mécanicien par son ID
        $mechanic = $mechanicRepository->getEntityById($id); // Utilisation de find() pour récupérer l'entité
    
        if (!$mechanic) {
            throw $this->createNotFoundException('Mécanicien non trouvé');
        }

        // Récupérer les garages associés à ce mécanicien
        $garages = $garageRepository->findBy(['mechanic' => $mechanic]);

        return $this->render('mechanics/show_garage.html.twig', [
            'mechanic' => $mechanic,
            'garages' => $garages, // Passer les garages récupérés à la vue
        ]);
    }
}
