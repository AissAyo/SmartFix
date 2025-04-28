<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Client;
use App\Entity\Garagiste;
use App\Entity\Mechanic;
use App\Entity\Seller;
use App\Entity\CarRentalService;
use App\Entity\ServiceClient;
use App\Entity\Admin;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findUserByEmail(string $email): ?User
    {
        // Recherche parmi toutes les entités incluant Admin
        return $this->getEntityManager()->getRepository(Client::class)->findOneBy(['email' => $email])
            ?? $this->getEntityManager()->getRepository(Admin::class)->findOneBy(['email' => $email])
            ?? $this->getEntityManager()->getRepository(Mechanic::class)->findOneBy(['email' => $email]);
    }

    public function findUserByResetToken(string $token)
    {
        // Recherche du token parmi toutes les entités incluant Admin
        return $this->getEntityManager()->getRepository(Client::class)->findOneBy(['resetToken' => $token])
            ?? $this->getEntityManager()->getRepository(Admin::class)->findOneBy(['resetToken' => $token])
            ?? $this->getEntityManager()->getRepository(Mechanic::class)->findOneBy(['resetToken' => $token]);
    }

    // Mettre à jour l'utilisateur (mot de passe, supprimer le token, etc.)
    public function updateUserPassword($user, string $hashedPassword)
    {
        $user->setPassword($hashedPassword);
        $user->setResetToken(null); // Supprimer le token
        $user->setTokenExpiration(null); // Supprimer la date d'expiration
        $this->getEntityManager()->flush();
    }
}
