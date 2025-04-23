<?php

namespace App\Service;

use App\Repository\GarageServiceRepository;
use Symfony\Component\HttpFoundation\Request;

class GarageServiceManager
{
    private GarageServiceRepository $garageServiceRepository;

    public function __construct(GarageServiceRepository $garageServiceRepository)
    {
        $this->garageServiceRepository = $garageServiceRepository;
    }

    public function getPaginatedServices(Request $request, int $itemsPerPage = 9): array
    {
        $page = $request->query->getInt('page', 1);
        $services = $this->garageServiceRepository->findAllWithPagination($page, $itemsPerPage);
        $totalItems = $this->garageServiceRepository->count([]);

        return [
            'services' => $services,
            'currentPage' => $page,
            'totalPages' => ceil($totalItems / $itemsPerPage)
        ];
    }
}