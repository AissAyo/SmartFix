<?php
namespace App\Controller;

use App\Entity\Conversation;
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

        $conversation = $this->entityManager
            ->getRepository(Conversation::class)
            ->find($data['conversation_id']);

        if (!$conversation) {
            return $this->json(['error' => 'Conversation not found'], 404);
        }

        // Verify the user is a participant
        if (!$conversation->hasParticipant($user)) {
            return $this->json(['error' => 'Not a conversation participant'], 403);
        }

        // Create and persist the message
        $message = new Message();
        $message->setConversation($conversation);
        $message->setContent($data['content']);
        $message->setSender($user); // This will handle the proper sender type

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
            'conversation_'.$conversation->getId(),
            $update
        );

        return $this->json([
            'status' => 'success',
            'message' => $update
        ]);
    }
}