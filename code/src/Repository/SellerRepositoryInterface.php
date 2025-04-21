<?php
namespace App\Repository;

use App\Entity\Seller;

interface SellerRepositoryInterface extends RepositoryInterface
{
    public function deleteEntity($entity): void;
}