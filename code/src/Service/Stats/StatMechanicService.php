<?php

namespace App\Service\Stats;

use App\Repository\MechanicRepository;

class StatMechanicService
{
    private MechanicRepository $mechanicRepository;

    public function __construct(MechanicRepository $mechanicRepository)
    {
        $this->mechanicRepository = $mechanicRepository;
    }

    public function getMechanicCount(): int
    {
        // Example: Return the number of mechanics in the database
        return $this->mechanicRepository->count([]);
    }

    // Add more methods for mechanic-related statistics as needed
}
