<?php
namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Message;
use App\Service\MercurePublisher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MessageController extends AbstractController
{
    private $entityManager;
    private $mercurePublisher;

    public function __construct(EntityManagerInterface $entityManager, MercurePublisher $mercurePublisher)
    {
        $this->entityManager = $entityManager;
        $this->mercurePublisher = $mercurePublisher;
    }

    #[Route('/message', name: 'send_message', methods: ['POST'])]
    public function sendMessage(Request $request, UserInterface $user): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $chat = $this->entityManager
            ->getRepository(Chat::class)
            ->find($data['chat_id']);

        if (!$chat) {
            return $this->json(['error' => 'Chat not found'], 404);
        }

        // Create and persist the message
        $message = new Message();
        $message->setChat($chat);
        $message->setContent($data['content']);
        
        if ($user instanceof \App\Entity\Client) {
            $message->setClientSender($user);
        } elseif ($user instanceof \App\Entity\Mechanic) {
            $message->setMechanicSender($user);
        }

        $this->entityManager->persist($message);
        $this->entityManager->flush();

        // Prepare Mercure update
        $update = [
            'id' => $message->getId(),
            'content' => $message->getContent(),
            'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
            'sender' => [
                'id' => $user->getId(),
                'type' => $message->getSenderType()
            ]
        ];

        // Publish to Mercure hub
        $this->mercurePublisher->publish(
            'chat_'.$chat->getId(),
            $update
        );

        return $this->json([
            'status' => 'success',
            'message' => $update
        ]);
    }
}