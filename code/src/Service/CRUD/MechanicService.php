<?php

namespace App\Service\CRUD;

use App\Entity\Mechanic;
use App\Repository\MechanicRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\FileUploader;

class MechanicService
{
    private MechanicRepository $mechanicRepository;
    private EntityManagerInterface $entityManager;
    private FileUploader $fileUploader;

    public function __construct(
        MechanicRepository $mechanicRepository,
        EntityManagerInterface $entityManager,
        FileUploader $fileUploader
    ) {
        $this->mechanicRepository = $mechanicRepository;
        $this->entityManager = $entityManager;
        $this->fileUploader = $fileUploader;
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
    public function getAllMechanicsQuery(): \Doctrine\ORM\QueryBuilder
    {
        return $this->entityManager
            ->getRepository(Mechanic::class)
            ->createQueryBuilder('m')
            ->orderBy('m.name', 'ASC');
    }

    public function getMechanicByEmail(string $email): ?Mechanic
    {
        return $this->mechanicRepository->findOneByEmail($email);
    }

}