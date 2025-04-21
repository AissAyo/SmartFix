<?php
namespace App\Entity;
use Symfony\Bridge\Doctrine\ArgumentResolver\EntityValueResolver;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $lastMessage = null;


    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'conversations')]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: ServiceClient::class, inversedBy: 'conversations')]
    #[ORM\JoinColumn(nullable: true)]
    private ?ServiceClient $serviceClient = null;

    #[ORM\ManyToOne(targetEntity: Mechanic::class, inversedBy: 'conversations')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Mechanic $mechanic = null;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'conversation', cascade: ['persist', 'remove'])]
    private Collection $messages;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $lastMessageAt = null;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }



    public function getMechanic(): ?Mechanic
    {
        return $this->mechanic;
    }

    public function setMechanic(?Mechanic $mechanic): self
    {
        $this->mechanic = $mechanic;
        return $this;
    }

    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setConversation($this);
            $this->lastMessageAt = new \DateTime();
        }
        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            if ($message->getConversation() === $this) {
                $message->setConversation(null);
            }
        }
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getLastMessageAt(): ?\DateTimeInterface
    {
        return $this->lastMessageAt;
    }

    // Helper methods
    public function getOtherParticipants(User $currentUser): array
    {
        $participants = [];

        if ($currentUser !== $this->client) {
            $participants[] = $this->client;
        }

        if ($this->serviceClient && $currentUser !== $this->serviceClient) {
            $participants[] = $this->serviceClient;
        }

        if ($this->mechanic && $currentUser !== $this->mechanic) {
            $participants[] = $this->mechanic;
        }

        return $participants;
    }

    public function getConversationType(): string
    {
        if ($this->serviceClient && !$this->mechanic) {
            return 'client_service';
        }
        if ($this->mechanic && !$this->serviceClient) {
            return 'client_mechanic';
        }
        return 'mixed';
    }

    public function getServiceClient(): ?ServiceClient
    {
        return $this->serviceClient;
    }

    public function setServiceClient(?ServiceClient $serviceClient): self
    {
        $this->serviceClient = $serviceClient;
        return $this;
    }

    public function getLastMessage(): ?string
    {
        return $this->lastMessage;
    }

    public function setLastMessage(string $message): self
    {
        $this->lastMessage = $message;
        return $this;
    }

}