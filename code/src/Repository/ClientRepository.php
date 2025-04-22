<?php
namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    

    public function __construct( ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

public function getEntityById(int $id): ?Client
{
    return $this->entityManager->getRepository(Client::class)->find($id);
}

public function getAllEntities(): array
{
return $this->findAll();
}

public function save($entity, bool $flush = true): void
{
$this->getEntityManager()->persist($entity);
if ($flush) {
$this->getEntityManager()->flush();
}
}

public function remove($entity, bool $flush = true): void
{
$this->getEntityManager()->remove($entity);
if ($flush) {
$this->getEntityManager()->flush();
}
}

public function existsByEmail(?string $email): bool
{
if (null === $email) {
return false;
}
return (bool) $this->createQueryBuilder('c')
->select('COUNT(c.id)')
->where('c.email = :email')
->setParameter('email', $email)
->getQuery()
->getSingleScalarResult();
}

public function phoneExists(string $phone): bool
{
return (bool) $this->createQueryBuilder('c')
->select('COUNT(c.id)')
->where('c.phone = :phone')
->setParameter('phone', $phone)
->getQuery()
->getSingleScalarResult();
}

public function getClientByCity(): array
{
return $this->createQueryBuilder('c')
->select('c.city', 'COUNT(c.id) as city_count')
->groupBy('c.city')
->getQuery()
->getResult();
}

public function getClientByStatus(): array
{
return $this->createQueryBuilder('c')
->select('c.verificationStatus', 'COUNT(c.id) as client_count')
->groupBy('c.verificationStatus')
->getQuery()
->getResult();
}
}