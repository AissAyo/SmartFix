<?php
namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\Client;
use App\Entity\Mechanic;
use App\Entity\ServiceClient;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class ConversationController extends AbstractController
{
    #[Route('/conversation/{id}', name: 'conversation_show')]
    public function show(Conversation $conversation, UserInterface $user)
    {
        // Verify the current user is a participant
        if (!$conversation->hasParticipant($user)) {
            throw $this->createAccessDeniedException('You are not a participant in this conversation');
        }

        // Get the JWT token for Mercure
        $jwtToken = $this->getMercureJWT($user);

        // Fetch messages for the conversation
        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findBy(['conversation' => $conversation], ['sentAt' => 'ASC']);

        return $this->render('chat.html.twig', [
            'conversation' => $conversation,
            'messages' => $messages,
            'current_user' => $user,
            'mercure_jwt_token' => $jwtToken,
            'mercure_topic' => 'conversation_'.$conversation->getId()
        ]);
    }

    private function getMercureJWT(UserInterface $user): string
    {
        // Implement your JWT generation logic here
        // Example: return $this->getParameter('mercure_jwt_token');
        return 'your-jwt-token';
    }
    #[Route('/create-test-conversation', name: 'create_test_conversation')]
    #[IsGranted('ROLE_ADMIN')]
    public function createTestConversation(EntityManagerInterface $em)
    {
        $client = $em->getRepository(Client::class)->find(1); // Get client with ID 1
        $serviceAgent = $em->getRepository(ServiceClient::class)->find(1); // Get service agent with ID 1

        $conversation = new Conversation();
        $conversation->setClient($client);
        $conversation->setServiceAgent($serviceAgent);
        $conversation->setLastMessage("Conversation started");

        $em->persist($conversation);
        $em->flush();

        return $this->redirectToRoute('conversation_show', ['id' => $conversation->getId()]);
    }
}