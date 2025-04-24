<?php
namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class VehiculeRepository extends ServiceEntityRepository
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
        $this->registry = $registry;
    }

    public function getEntityById(int $id): ?Vehicule
    {
        if ($id <= 0) {
            // Si l'ID est invalide
            return null;
        }

        return $this->find($id);
    }

    public function getAllEntities(): array
    {
        return $this->findAll();
    }

    public function addEntity(Vehicule $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function updateEntity(Vehicule $entity): void
    {
        $this->getEntityManager()->merge($entity);
        $this->getEntityManager()->flush();
    }

    public function deleteEntity(Vehicule $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->registry->getManager();
    }
}
