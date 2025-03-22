<?php

namespace App\Service\CRUD;

use App\Entity\Mechanic;
use App\Repository\MechanicRepository;
use Doctrine\ORM\EntityManagerInterface;

class MechanicService
{
    private MechanicRepository $mechanicRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(MechanicRepository $mechanicRepository, EntityManagerInterface $entityManager)
    {
        $this->mechanicRepository = $mechanicRepository;
        $this->entityManager = $entityManager;
    }

    public function getMechanic(int $id): ?Mechanic
    {
        return $this->mechanicRepository->getEntityById($id);
    }

    public function getAllMechanics(): array
    {
        return $this->mechanicRepository->getAllEntities();
    }

    public function createMechanic(Mechanic $mechanic): void
    {
        $this->mechanicRepository->addEntity($mechanic);
    }

    public function updateMechanic(Mechanic $mechanic): void
    {
        $this->mechanicRepository->updateEntity($mechanic);
    }

    public function deleteMechanic(Mechanic $mechanic): void
    {
        $this->mechanicRepository->deleteEntity($mechanic, true);
    }
}