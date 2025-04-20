<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Conversation::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private Conversation $conversation;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'sentMessages')]
    private ?Client $clientSender = null;

    #[ORM\ManyToOne(targetEntity: Mechanic::class, inversedBy: 'sentMessages')]
    private ?Mechanic $mechanicSender = null;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $sentAt;

    #[ORM\Column(type: 'boolean')]
    private bool $isRead = false;

    #[ORM\Column(type: 'string', length: 50)]
    private string $senderType;

    public function __construct()
    {
        $this->sentAt = new \DateTime();
    }

    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConversation(): Conversation
    {
        return $this->conversation;
    }

    public function setConversation(Conversation $conversation): self
    {
        $this->conversation = $conversation;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getSentAt(): \DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;
        return $this;
    }

    public function isRead(): bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;
        return $this;
    }

    public function getSenderType(): string
    {
        return $this->senderType;
    }

    public function setSenderType(string $senderType): self
    {
        $this->senderType = $senderType;
        return $this;
    }

    public function getClientSender(): ?Client
    {
        return $this->clientSender;
    }

    public function setClientSender(?Client $clientSender): self
    {
        $this->clientSender = $clientSender;
        if ($clientSender !== null) {
            $this->senderType = 'client';
        }
        return $this;
    }

    public function getMechanicSender(): ?Mechanic
    {
        return $this->mechanicSender;
    }

    public function setMechanicSender(?Mechanic $mechanicSender): self
    {
        $this->mechanicSender = $mechanicSender;
        if ($mechanicSender !== null) {
            $this->senderType = 'mechanic';
        }
        return $this;
    }
}