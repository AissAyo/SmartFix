<?php

namespace App\Service;

use App\Entity\Seller;
use App\Repository\SellerRepository;

class SellerService
{
    private SellerRepository $sellerRepository;

    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function getSeller(int $id): ?Seller
    {
        return $this->sellerRepository->find($id);
    }

    public function getAllSellers(): array
    {
        return $this->sellerRepository->findAll();
    }

    public function createSeller(Seller $seller): void
    {
        $this->sellerRepository->save($seller);
    }

    public function updateSeller(Seller $seller): void
    {
        $this->sellerRepository->save($seller);
    }

    public function deleteSeller(Seller $seller): void
    {
        $this->sellerRepository->delete($seller);
    }
}
