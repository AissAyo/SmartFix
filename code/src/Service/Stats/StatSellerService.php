<?php

namespace App\Service\Stats;

use App\Repository\SellerRepository;

class StatSellerService
{
    private SellerRepository $sellerRepository;

    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function getSellerCount(): int
    {
        // Example: Return the number of sellers in the database
        return $this->sellerRepository->count([]);
    }

    // Add more methods for seller-related statistics as needed
}
