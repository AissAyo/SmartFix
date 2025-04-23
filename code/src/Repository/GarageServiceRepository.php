<?php

namespace App\Repository;

use App\Entity\CarAPI;
use App\Entity\GarageService;
use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GarageService|null find($id, $lockMode = null, $lockVersion = null)
 * @method GarageService|null findOneBy(array $criteria, array $orderBy = null)
 * @method GarageService[]    findAll()
 * @method GarageService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GarageServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GarageService::class);
    }
    public function findAllWithServices(): array
    {
        return $this->createQueryBuilder('gs')
            ->select('DISTINCT s')
            ->leftJoin('gs.service', 's')
            ->leftJoin('s.category', 'c')
            ->addSelect('c')
            ->getQuery()
            ->getResult();
    }

    public function findAllWithGarageAndReviews(): array
    {
        return $this->createQueryBuilder('gs')
            ->leftJoin('gs.garage', 'g') // Jointure avec la table Garage
            ->addSelect('g')  // Sélectionner le Garage associé à chaque GarageService
            ->leftJoin('gs.reviews', 'r') // Jointure avec la table Reviews
            ->addSelect('r')  // Sélectionner les Reviews associées à chaque GarageService
            ->getQuery()
            ->getResult(); // Exécuter la requête et retourner les résultats
    }

    public function findAllServices(): array
    {
        return $this->createQueryBuilder('gs')
            ->select('gs')
            ->getQuery()
            ->getResult();
    }

    public function findAllWithPagination(int $page, int $itemsPerPage): array
    {
        $qb = $this->createQueryBuilder('gs');
        
        $qb->setFirstResult(($page - 1) * $itemsPerPage)
           ->setMaxResults($itemsPerPage);
        
        return $qb->getQuery()->getResult();
    }

    public function findByVehicleWithPagination(int $page, int $itemsPerPage, Vehicule $vehicule): array
    {
        $qb = $this->createQueryBuilder('gs')
            ->where('gs.carAPI = :carAPI')
            ->setParameter('carAPI', $vehicule->getCarAPI()->getId());

        $qb->setFirstResult(($page - 1) * $itemsPerPage)
           ->setMaxResults($itemsPerPage);
        
        return $qb->getQuery()->getResult();
    }

    public function countForVehicle(Vehicule $vehicule): int
    {
        return (int) $this->createQueryBuilder('gs')
            ->select('COUNT(gs)')
            ->where('gs.carAPI = :carAPI')
            ->setParameter('carAPI', $vehicule->getCarAPI()->getId())
        ->getQuery()
            ->getSingleScalarResult();
    }

    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('gs')
            ->select('COUNT(gs)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function findByServiceWithPagination(int $page, int $limit, int $serviceId): array
    {
        return $this->createQueryBuilder('g')
            ->join('g.service', 's')
            ->where('s.Id = :serviceId')
            ->setParameter('serviceId', $serviceId)
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function countByService(int $serviceId): int
    {
        return $this->createQueryBuilder('g')
            ->select('COUNT(g.id)')
            ->join('g.service', 's')
            ->where('s.Id = :serviceId')
            ->setParameter('serviceId', $serviceId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findByCarAPIAndServiceWithPagination(int $page, int $limit, CarAPI $carAPI, int $serviceId): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.carAPI = :carAPI')
            ->andWhere('g.service = :service')
            ->setParameter('carAPI', $carAPI)
            ->setParameter('service', $serviceId)
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function countByCarAPIAndService(CarAPI $carAPI, int $serviceId): int
    {
        return $this->createQueryBuilder('g')
            ->select('COUNT(g.id)')
            ->where('g.carAPI = :carAPI')
            ->andWhere('g.service = :service')
            ->setParameter('carAPI', $carAPI)
            ->setParameter('service', $serviceId)
            ->getQuery()
            ->getSingleScalarResult();
}


    //    /**
    //     * @return GarageService[] Returns an array of GarageService objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GarageService
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}