<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Client;
use App\Entity\Garagiste;
use App\Entity\Mechanic;
use App\Entity\ServiceClient;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);  // Ensure proper initialization
    }

    public function findUserByEmail(string $email): ?User
    {
        // Recherche de l'utilisateur dans la table Client
        $user = $this->getEntityManager()->getRepository(Client::class)->findOneBy(['email' => $email]);

        // Si l'utilisateur n'est pas trouvé parmi les Clients, on cherche dans les ServiceClients
        if (!$user) {
            $user = $this->getEntityManager()->getRepository(ServiceClient::class)->findOneBy(['email' => $email]);
        }

        // Retourne l'utilisateur trouvé ou null si aucun utilisateur n'a été trouvé
        return $user;
    }

    public function findUserByResetToken(string $token)
    {
        return $this->getEntityManager()->getRepository(Client::class)->findOneBy(['resetToken' => $token])
            ?? $this->getEntityManager()->getRepository(ServiceClient::class)->findOneBy(['resetToken' => $token]);
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
