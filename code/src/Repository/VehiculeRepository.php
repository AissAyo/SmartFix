<?php
namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
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

        return $this->entityManager->getRepository(vehicule::class)->findAll();
    }


    public function addEntity(Vehicule $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function updateEntity(Vehicule $entity): void
    {
        $this->_em->merge($entity);
        $this->_em->flush();
    }

    public function deleteEntity(Vehicule $entity): void
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }
}
