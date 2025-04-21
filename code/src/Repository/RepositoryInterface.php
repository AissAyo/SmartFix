<?php
namespace App\Repository;

interface RepositoryInterface
{
    public function getEntityById(int $id);
    public function getAllEntities(): array;
    public function addEntity($entity): void;
    public function updateEntity($entity): void;
    public function deleteEntity($entity): void;
}