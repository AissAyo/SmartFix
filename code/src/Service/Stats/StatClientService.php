<?php

namespace App\Service\Stats;

use App\Repository\ClientRepository;

class StatClientService
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getClientCount(): int
    {
        // Example: Return the number of clients in the database
        return $this->clientRepository->count([]);
    }

    // Add more methods for client-related statistics as needed
}
