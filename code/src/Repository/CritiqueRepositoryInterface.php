<?php
namespace App\Repository;

interface CritiqueRepositoryInterface extends RepositoryInterface
{
    public function getAverageRatingForGarage(int $garageId): float;
    public function getAverageRatingForSeller(int $SellerId): float;
    public function getAverageRatingForCarRental(int $CarRentalServiceId): float;
}