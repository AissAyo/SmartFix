<?php
<<<<<<< HEAD

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
=======
namespace App\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Payement;

class PayementRepositoryInterface extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payement::class);
    }
>>>>>>> b5f74be67730947e6fc0467d1ad111ea928ffcf3
}