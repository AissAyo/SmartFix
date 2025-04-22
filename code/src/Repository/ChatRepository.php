<?php

namespace App\Repository;

use App\Entity\Chat;
use App\Entity\Client;
use App\Entity\Mechanic;
use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chat::class);
    }

    public function getChatHistory(Client $client, Mechanic $mechanic): array
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from(Message::class, 'm')
            ->join('m.chat', 'c')
            ->where('c.client = :client')
            ->andWhere('c.mechanic = :mechanic')
            ->setParameter('client', $client)
            ->setParameter('mechanic', $mechanic)
            ->orderBy('m.sentAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function markMessagesAsRead(Client $client, Mechanic $mechanic): void
    {
        $this->createQueryBuilder('c')
            ->update()
            ->set('c.isRead', ':isRead')
            ->where('c.client = :client')
            ->andWhere('c.mechanic = :mechanic')
            ->andWhere('c.isRead = :notRead')
            ->setParameter('client', $client)
            ->setParameter('mechanic', $mechanic)
            ->setParameter('isRead', true)
            ->setParameter('notRead', false)
            ->getQuery()
            ->execute();
    }
} 