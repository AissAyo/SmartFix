<?php
namespace App\Service;

use App\Repository\GarageServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\GarageService;

class GarageServiceService
{
    private $garageServiceRepository;

    public function __construct(GarageServiceRepository $garageServiceRepository,EntityManagerInterface $entityManager)
    {
        $this->garageServiceRepository = $garageServiceRepository;
        $this->entityManager = $entityManager; // Initialiser l'EntityManager

    }
    public function getGarageServicesByCarApiId($carApiId)
    {
        return $this->entityManager->getRepository(GarageService::class)
            ->createQueryBuilder('gs')
            ->innerJoin('gs.carAPI', 'car')
            ->where('car.id = :carApiId')
            ->setParameter('carApiId', $carApiId)
            ->getQuery()
            ->getResult();
    }


    public function getAllGarageServicesWithGarageAndReviews()
    {
        // Appeler la méthode du repository pour obtenir les données
        return $this->garageServiceRepository->findAllWithGarageAndReviews();
    }
    // Méthode pour obtenir une query paginée
    public function getAllGarageServicesWithGarageAndReviewsQuery()
    {
        return $this->entityManager->getRepository(GarageService::class)
            ->createQueryBuilder('gs')
            ->innerJoin('gs.garage', 'g')
            ->leftJoin('gs.reviews', 'r')
            ->innerJoin('gs.service', 's')
            ->addSelect('g', 'r', 's')
            ->getQuery();
    }
    public function getGarageServicesByVehicleId(int $vehicleId)
    {
        // Logique pour récupérer les services associés au véhicule
        return $this->entityManager->getRepository(GarageService::class)
            ->findBy(['carAPI' => $vehicleId]);
    }
}
