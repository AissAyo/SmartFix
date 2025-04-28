<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Client;
use App\Entity\Mechanic;
use App\Entity\Message;
use App\Repository\ChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

#[Route('/chat')]
class ChatController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ChatRepository $chatRepository,
        private SerializerInterface $serializer,
        private HubInterface $hub
    ) {
    }

    #[Route('/mechanic/{client}', name: 'app_chat_mechanic', methods: ['GET'])]
    public function mechanicChat(Client $client): Response
    {
        // For testing, get or create a mechanic
        // @var Mechanic $mechanic 
        $mechanic = $this->getUser();
        if (!$mechanic) {
            $mechanic = $this->entityManager->getRepository(Mechanic::class)->find(5);
            if (!$mechanic) {
                $mechanic = new Mechanic();
                $mechanic->setName('Test Mechanic');
                $mechanic->setEmail('test.mechanic@example.com');
                $mechanic->setPassword('test123');
                $this->entityManager->persist($mechanic);
                $this->entityManager->flush();
            }
        }
        
        $chat = $this->chatRepository->findOneBy([
            'client' => $client,
            'mechanic' => $mechanic
        ]);
        
        if (!$chat) {
            $chat = new Chat();
            $chat->setClient($client)
                ->setMechanic($mechanic);
            $this->entityManager->persist($chat);
            $this->entityManager->flush();
        }
        
        $messages = $this->chatRepository->getChatHistory($client, $mechanic);
        
        return $this->render('chat/mechanic.html.twig', [
            'chat' => $chat,
            'messages' => $messages,
            'client' => $client,
            'mechanic' => $mechanic,
            'mercure_hub_url' => $this->getParameter('mercure.public_url')
        ]);
    }

    #[Route('/start/{mechanic}', name: 'app_chat_start', methods: ['GET'])]
    public function start(Mechanic $mechanic): Response
    {
        // For testing, get or create a client
        /** @var Client $client */
        $client = $this->getUser();
        if (!$client) {
            $client = $this->entityManager->getRepository(Client::class)->find(5);
            if (!$client) {
                $client = new Client();
                $client->setName('Test Client');
                $client->setEmail('test.client@example.com');
                $client->setPassword('test123');
                $this->entityManager->persist($client);
                $this->entityManager->flush();
            }
        }
        
        // Check if a chat already exists
        $existingChat = $this->chatRepository->findOneBy([
            'client' => $client,
            'mechanic' => $mechanic
        ]);
        
        if ($existingChat) {
            return $this->redirectToRoute('app_chat_show', ['mechanic' => $mechanic->getId()]);
        }
        
        // Create a new chat
        $chat = new Chat();
        $chat->setClient($client)
            ->setMechanic($mechanic)
            ->setIsRead(false);
        
        $this->entityManager->persist($chat);
        $this->entityManager->flush();
        
        // Notify the mechanic about the new chat request
        $this->publishToMercure($chat, 'new_chat_request');
        
        return $this->render('chat/popup.html.twig', [
            'mechanic' => $mechanic,
            'client' => $client,
            'chat' => $chat,
            'messages' => [],
            'mercure_hub_url' => $this->getParameter('mercure.public_url')
        ]);
    }

    #[Route('/{mechanic}', name: 'app_chat_show', methods: ['GET'])]
    public function show(Mechanic $mechanic): Response
    {
        // For testing, get or create a client
        /** @var Client $client */
        $client = $this->getUser();
        if (!$client) {
            $client = $this->entityManager->getRepository(Client::class)->find(5);
            if (!$client) {
                $client = new Client();
                $client->setName('Test Client');
                $client->setEmail('test.client@example.com');
                $client->setPassword('test123');
                $this->entityManager->persist($client);
                $this->entityManager->flush();
            }
        }
        
        $chat = $this->chatRepository->findOneBy([
            'client' => $client,
            'mechanic' => $mechanic
        ]);
        
        if (!$chat) {
            return $this->redirectToRoute('app_chat_start', ['mechanic' => $mechanic->getId()]);
        }
        
        $messages = $this->chatRepository->getChatHistory($client, $mechanic);
        
        return $this->render('chat/popup.html.twig', [
            'mechanic' => $mechanic,
            'client' => $client,
            'chat' => $chat,
            'messages' => $messages,
            'mercure_hub_url' => $this->getParameter('mercure.public_url')
        ]);
    }

    #[Route('/send/{mechanic}', name: 'app_chat_send', methods: ['POST'])]
    public function send(Request $request, Mechanic $mechanic): Response
    {
        try {
            $content = $request->getContent();
            error_log('Raw request content: ' . $content);
            
            $data = json_decode($content, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                error_log('JSON decode error: ' . json_last_error_msg());
                return $this->json(['error' => 'Invalid JSON: ' . json_last_error_msg()], 400);
            }
            
            if (empty($data['content'])) {
                return $this->json(['error' => 'Message content cannot be empty'], 400);
            }

            // For testing, create a dummy client if no user is authenticated
            $client = $this->getUser() ?? (new Client())->setId(5)->setName('Test Client');

            // Get or create chat
            $chat = $this->chatRepository->findOneBy(['client' => $client, 'mechanic' => $mechanic]);
            if (!$chat) {
                $chat = new Chat();
                $chat->setClient($client);
                $chat->setMechanic($mechanic);
                $this->entityManager->persist($chat);
            }

            // Create message
            $message = new Message();
            $message->setContent($data['content']);
            $message->setChat($chat);
            $message->setClientSender($client);
            $message->setSentAt(new \DateTimeImmutable());
            $message->setSenderType('client'); // Explicitly set sender type

            $this->entityManager->persist($message);
            $this->entityManager->flush();

            // Publish to Mercure
            $update = new Update(
                'chat/' . $client->getId() . '/' . $mechanic->getId(),
                json_encode([
                    'type' => 'message',
                    'message' => [
                        'id' => $message->getId(),
                        'content' => $message->getContent(),
                        'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
                        'senderType' => $message->getSenderType(),
                        'sender' => [
                            'id' => $client->getId(),
                            'name' => $client->getName()
                        ]
                    ]
                ])
            );

            try {
                $this->hub->publish($update);
            } catch (\Exception $e) {
                error_log('Mercure publish error: ' . $e->getMessage());
                error_log('Stack trace: ' . $e->getTraceAsString());
                // Don't fail the request if Mercure publishing fails
            }

            return $this->json([
                'status' => 'success',
                'message' => [
                    'id' => $message->getId(),
                    'content' => $message->getContent(),
                    'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
                    'senderType' => $message->getSenderType()
                ]
            ]);
        } catch (\Exception $e) {
            error_log('Chat send error: ' . $e->getMessage());
            error_log('Stack trace: ' . $e->getTraceAsString());
            return $this->json(['error' => 'Failed to send message: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/{mechanic}/join', name: 'app_chat_join', methods: ['POST'])]
    public function join(Mechanic $mechanic): JsonResponse
    {
        try {
            // For testing, get or create a client
            /** @var Client $client */
            $client = $this->getUser();
            if (!$client) {
                $client = $this->entityManager->getRepository(Client::class)->find(5);
                if (!$client) {
                    $client = new Client();
                    $client->setName('Test Client');
                    $client->setEmail('test.client@example.com');
                    $client->setPassword('test123');
                    $this->entityManager->persist($client);
                    $this->entityManager->flush();
                }
            }
            
            $chat = $this->chatRepository->findOneBy([
                'client' => $client,
                'mechanic' => $mechanic
            ]);
            
            if (!$chat) {
                return new JsonResponse(['error' => 'Chat not found'], Response::HTTP_NOT_FOUND);
            }
            
            // Mark the chat as read (mechanic joined)
            $chat->setIsRead(true);
            $this->entityManager->flush();
            
            // Notify the client that the mechanic joined
            $this->publishToMercure($chat, 'mechanic_joined');
            
            return new JsonResponse([
                'status' => 'success',
                'message' => 'Successfully joined the conversation'
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => 'Failed to join conversation: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/{mechanic}/mark-read', name: 'app_chat_mark_read', methods: ['POST'])]
    public function markAsRead(Mechanic $mechanic): JsonResponse
    {
        // For testing, get or create a client
        /** @var Client $client */
        $client = $this->getUser();
        if (!$client) {
            $client = $this->entityManager->getRepository(Client::class)->find(5);
            if (!$client) {
                $client = new Client();
                $client->setName('Test Client');
                $client->setEmail('test.client@example.com');
                $client->setPassword('test123');
                $this->entityManager->persist($client);
                $this->entityManager->flush();
            }
        }
        
        $this->chatRepository->markMessagesAsRead($client, $mechanic);
        
        return new JsonResponse(['status' => 'success']);
    }

    #[Route('/mechanic/send/{client}', name: 'app_chat_mechanic_send', methods: ['POST'])]
    public function mechanicSend(Request $request, Client $client): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (empty($data['content'])) {
                return $this->json(['error' => 'Message content cannot be empty'], 400);
            }

            // For testing, get or create a mechanic
            /** @var Mechanic $mechanic */
            $mechanic = $this->getUser();
            if (!$mechanic) {
                $mechanic = $this->entityManager->getRepository(Mechanic::class)->find(5);
                if (!$mechanic) {
                    $mechanic = new Mechanic();
                    $mechanic->setName('Test Mechanic');
                    $mechanic->setEmail('test.mechanic@example.com');
                    $mechanic->setPassword('test123');
                    $this->entityManager->persist($mechanic);
                    $this->entityManager->flush();
                }
            }

            // Get or create chat
            $chat = $this->chatRepository->findOneBy(['client' => $client, 'mechanic' => $mechanic]);
            if (!$chat) {
                $chat = new Chat();
                $chat->setClient($client);
                $chat->setMechanic($mechanic);
                $this->entityManager->persist($chat);
            }

            // Create message
            $message = new Message();
            $message->setContent($data['content']);
            $message->setChat($chat);
            $message->setMechanicSender($mechanic); // This will set senderType to 'mechanic'
            $message->setClientSender(null); // Ensure clientSender is null
            $message->setSentAt(new \DateTimeImmutable());

            $this->entityManager->persist($message);
            $this->entityManager->flush();

            // Publish to Mercure
            $update = new Update(
                'chat/' . $mechanic->getId() . '/' . $client->getId(),
                json_encode([
                    'type' => 'message',
                    'message' => [
                        'id' => $message->getId(),
                        'content' => $message->getContent(),
                        'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
                        'senderType' => $message->getSenderType(),
                        'sender' => [
                            'id' => $mechanic->getId(),
                            'name' => $mechanic->getName()
                        ]
                    ]
                ])
            );

            $this->hub->publish($update);

            return $this->json([
                'status' => 'success',
                'message' => [
                    'id' => $message->getId(),
                    'content' => $message->getContent(),
                    'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
                    'senderType' => $message->getSenderType()
                ]
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Failed to send message: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/client/send/{mechanic}', name: 'app_chat_client_send', methods: ['POST'])]
    public function clientSend(Request $request, Mechanic $mechanic): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (empty($data['content'])) {
                return $this->json(['error' => 'Message content cannot be empty'], 400);
            }

            // For testing, get or create a client
            /** @var Client $client */
            $client = $this->getUser();
            if (!$client) {
                $client = $this->entityManager->getRepository(Client::class)->find(5);
                if (!$client) {
                    $client = new Client();
                    $client->setName('Test Client');
                    $client->setEmail('test.client@example.com');
                    $client->setPassword('test123');
                    $this->entityManager->persist($client);
                    $this->entityManager->flush();
                }
            }

            // Get or create chat
            $chat = $this->chatRepository->findOneBy(['client' => $client, 'mechanic' => $mechanic]);
            if (!$chat) {
                $chat = new Chat();
                $chat->setClient($client);
                $chat->setMechanic($mechanic);
                $this->entityManager->persist($chat);
            }

            // Create message
            $message = new Message();
            $message->setContent($data['content']);
            $message->setChat($chat);
            $message->setClientSender($client); // This will set senderType to 'client'
            $message->setMechanicSender(null); // Ensure mechanicSender is null
            $message->setSentAt(new \DateTimeImmutable());

            $this->entityManager->persist($message);
            $this->entityManager->flush();

            // Publish to Mercure
            $update = new Update(
                'chat/' . $client->getId() . '/' . $mechanic->getId(),
                json_encode([
                    'type' => 'message',
                    'message' => [
                        'id' => $message->getId(),
                        'content' => $message->getContent(),
                        'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
                        'senderType' => $message->getSenderType(),
                        'sender' => [
                            'id' => $client->getId(),
                            'name' => $client->getName()
                        ]
                    ]
                ])
            );

            $this->hub->publish($update);

            return $this->json([
                'status' => 'success',
                'message' => [
                    'id' => $message->getId(),
                    'content' => $message->getContent(),
                    'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
                    'senderType' => $message->getSenderType()
                ]
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Failed to send message: ' . $e->getMessage()], 500);
        }
    }

    private function publishToMercure(Chat $chat, string $type, ?Message $message = null): void
    {
        $data = [
            'type' => $type,
            'chatId' => $chat->getId(),
            'client' => [
                'id' => $chat->getClient()->getId(),
                'name' => $chat->getClient()->getName(),
            ],
            'mechanic' => [
                'id' => $chat->getMechanic()->getId(),
                'name' => $chat->getMechanic()->getName(),
            ],
        ];
        
        if ($message) {
            $data['message'] = [
                'id' => $message->getId(),
                'content' => $message->getContent(),
                'senderType' => $message->getSenderType(),
                'sentAt' => $message->getSentAt()->format('Y-m-d H:i:s'),
                'isRead' => $message->isRead()
            ];
        }
        
        if ($type === 'mechanic_joined') {
            $data['status'] = 'joined';
        }
        
        $topic = sprintf('chat/%d/%d', $chat->getMechanic()->getId(), $chat->getClient()->getId());
        
        // Debug information
        error_log('Publishing to Mercure:');
        error_log('Topic: ' . $topic);
        error_log('Data: ' . json_encode($data, JSON_PRETTY_PRINT));
        error_log('Mercure URL: ' . $this->getParameter('mercure.public_url'));
        error_log('JWT Secret: ' . $this->getParameter('mercure.default_hub.jwt.secret'));
        
        try {
            $update = new Update(
                $topic,
                json_encode($data),
                true // This will include the JWT token
            );
            
            error_log('Created Mercure update object');
            error_log('Update topic: ' . $update->getTopics()[0]);
            error_log('Update data: ' . $update->getData());
            
            $this->hub->publish($update);
            error_log('Successfully published to Mercure');
        } catch (\Exception $e) {
            error_log('Error publishing to Mercure: ' . $e->getMessage());
            error_log('Stack trace: ' . $e->getTraceAsString());
            error_log('Error class: ' . get_class($e));
            throw $e;
        }
    }
} 