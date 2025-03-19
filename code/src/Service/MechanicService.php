<?php

namespace App\Service;

use App\Entity\Mechanic;
use App\Repository\MechanicRepository;

class MechanicService
{
    private MechanicRepository $mechanicRepository;

    public function __construct(MechanicRepository $mechanicRepository)
    {
        $this->mechanicRepository = $mechanicRepository;
    }

    public function getMechanic(int $id): ?Mechanic
    {
        return $this->mechanicRepository->find($id);
    }

    public function getAllMechanics(): array
    {
        return $this->mechanicRepository->findAll();
    }

    public function createMechanic(Mechanic $mechanic): void
    {
        $this->mechanicRepository.save($mechanic);
    }

    public function updateMechanic(Mechanic $mechanic): void
    {
        $this->mechanicRepository.save($mechanic);
    }

    public function deleteMechanic(Mechanic $mechanic): void
    {
        $this->mechanicRepository.delete($mechanic);
    }
}