<?php

namespace App\Service\CRUD;

use App\Entity\Seller;
use App\Repository\SellerRepository;
use Doctrine\ORM\EntityManagerInterface;

class SellerService
{
    private SellerRepository $sellerRepository;
    private EntityManagerInterface $entityManager;


    public function __construct(SellerRepository $sellerRepository, EntityManagerInterface $entityManager)
    {
        $this->sellerRepository = $sellerRepository;
        $this->entityManager = $entityManager;
    }

    public function getSeller(int $id): ?Seller
    {
        return $this->sellerRepository->getEntityById($id);
    }

    public function getAllSellers(): array
    {
        return $this->sellerRepository->getAllEntities();
    }

    public function createSeller(Seller $seller): void
    {

        $this->sellerRepository->addEntity($seller);
    }

    public function updateSeller(Seller $seller): void
    {
        $this->sellerRepository->updateEntity($seller);
    }

    public function deleteSeller(Seller $seller): void
    {
        $this->sellerRepository->deleteEntity($seller , true);
    }
}
