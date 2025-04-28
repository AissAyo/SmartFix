<?php

namespace App\Service\Client;

use App\Entity\Garage;
use App\Repository\GarageRepository;
use App\Repository\ClientRepository;
use App\Service\UserSessionManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Client\RecommenderService;

class GarageService
{
    private GarageRepository $garageRepository;
    private ClientRepository $clientRepository;
    private PaginatorInterface $paginator;
    private UserSessionManager $userSessionManager;
    private RecommenderService $recommenderService;

    public function __construct(
        GarageRepository $garageRepository,
        ClientRepository $clientRepository,
        PaginatorInterface $paginator,
        UserSessionManager $userSessionManager,
        RecommenderService $recommenderService
    ) {
        $this->garageRepository = $garageRepository;
        $this->clientRepository = $clientRepository;
        $this->paginator = $paginator;
        $this->userSessionManager = $userSessionManager;
        $this->recommenderService = $recommenderService;
    }

    public function getGarageById(int $id): ?Garage
    {
        $garage = $this->garageRepository->createQueryBuilder('g')
            ->leftJoin('g.categoryServices', 'cs')
            ->leftJoin('cs.services', 's')
            ->addSelect('cs', 's')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        
        if ($garage) {
            $userSession = $this->userSessionManager->getUser();
            if ($userSession && isset($userSession['email'])) {
                $client = $this->clientRepository->findOneBy(['email' => $userSession['email']]);
                if ($client && $client->getLocation() && $garage->getLocation()) {
                    $distance = $this->calculateDistance(
                        $client->getLocation()->getLatitude(),
                        $client->getLocation()->getLongitude(),
                        $garage->getLocation()->getLatitude(),
                        $garage->getLocation()->getLongitude()
                    );
                    $garage->distance = $distance;
                }
            }
        }

        return $garage;
    }

    public function getPaginatedGarages(Request $request, int $itemsPerPage = 6): array
    {
        $userSession = $this->userSessionManager->getUser();
        $clientLocation = null;
        $recommendedGarageIds = [];

        // Get recommended garages if user is logged in
        if ($userSession && isset($userSession['id'])) {
            $recommendedGarageIds = $this->recommenderService->getRecommendedGarageIds($userSession['id']);
        }

        if ($userSession && isset($userSession['email'])) {
            $client = $this->clientRepository->findOneBy(['email' => $userSession['email']]);
            if ($client && $client->getLocation()) {
                $clientLocation = $client->getLocation();
            }
        }

        $queryBuilder = $this->garageRepository->createQueryBuilder('g')
            ->leftJoin('g.location', 'gl');

        if ($clientLocation) {
            $queryBuilder
                ->andWhere('gl.city = :city')
                ->setParameter('city', $clientLocation->getCity());
        }

        // Exclude recommended garages from the main query if we're on the first page
        $page = $request->query->getInt('page', 1);
        if ($page === 1 && !empty($recommendedGarageIds)) {
            $queryBuilder
                ->andWhere('g.id NOT IN (:recommendedIds)')
                ->setParameter('recommendedIds', $recommendedGarageIds);
        }

        $queryBuilder->orderBy('g.name', 'ASC');
        $query = $queryBuilder->getQuery();

        $garages = $this->paginator->paginate(
            $query,
            $page,
            $itemsPerPage
        );

        // If we're on the first page and have recommended garages, prepend them
        if ($page === 1 && !empty($recommendedGarageIds)) {
            $recommendedGarages = $this->getGaragesByIds($recommendedGarageIds);
            
            // Calculate distances for recommended garages
            foreach ($recommendedGarages as $garage) {
                if ($clientLocation && $garage->getLocation()) {
                    $distance = $this->calculateDistance(
                        $clientLocation->getLatitude(),
                        $clientLocation->getLongitude(),
                        $garage->getLocation()->getLatitude(),
                        $garage->getLocation()->getLongitude()
                    );
                    $garage->distance = $distance;
                }
            }

            // Prepend recommended garages to the paginated results
            $allItems = array_merge($recommendedGarages, iterator_to_array($garages->getItems()));
            $garages->setItems($allItems);
        } else {
            // Calculate distances for regular garages
            foreach ($garages as $garage) {
                if ($clientLocation && $garage->getLocation()) {
                    $distance = $this->calculateDistance(
                        $clientLocation->getLatitude(),
                        $clientLocation->getLongitude(),
                        $garage->getLocation()->getLatitude(),
                        $garage->getLocation()->getLongitude()
                    );
                    $garage->distance = $distance;
                }
            }
        }

        return [
            'pagination' => $garages,
            'recommendedIds' => $recommendedGarageIds
        ];
    }

    private function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta/2) * sin($latDelta/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lonDelta/2) * sin($lonDelta/2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return round($earthRadius * $c, 1); // Distance in kilometers, rounded to 1 decimal place
    }

    public function getGaragesByIds(array $ids): array
    {
        return $this->garageRepository->findBy(['id' => $ids]);
    }

    public function getRecommendedGarages(): array
    {
        $userSession = $this->userSessionManager->getUser();
        if (!$userSession || !isset($userSession['id'])) {
            return [];
        }

        $clientId = $userSession['id'];
        $recommendedGarageIds = $this->recommenderService->getRecommendedGarageIds($clientId);

        if (empty($recommendedGarageIds)) {
            return [];
        }

        return $this->getGaragesByIds($recommendedGarageIds);
    }
} 