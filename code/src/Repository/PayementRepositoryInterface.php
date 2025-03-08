<?php

namespace App\Repository;

use App\Entity\Payement;

interface PayementRepositoryInterface
{
    public function find($id): ?Payement;
    public function findOneBy(array $criteria): ?Payement;
    public function findAll(): array;
    public function findBy(array $criteria): array;
    public function save(Payement $payement): void;
    public function delete(Payement $payement): void;
}