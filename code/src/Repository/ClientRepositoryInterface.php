<?php
namespace App\Repository;

use App\Entity\Client;

interface ClientRepositoryInterface
{
public function getEntityById(int $id): ?Client;
public function getAllEntities(): array;
public function save($entity, bool $flush = true): void;
public function remove($entity, bool $flush = true): void;
public function existsByEmail(?string $email): bool;
public function phoneExists(string $phone): bool;
public function getClientByCity(): array;
public function getClientByStatus(): array;
}