<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Complaint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string', length: 255)]
    private string $service;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'string', length: 50)]
    private string $status = 'Pending'; // e.g., Pending, Resolved, Rejected

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'complaints')]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: ServiceClient::class, inversedBy: "complaints")]
    #[ORM\JoinColumn(nullable: false)]
    private ServiceClient $serviceClient;
    

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
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

    public function getServiceClient(): ServiceClient
    {
        return $this->serviceClient;
    }

    public function setServiceClient(ServiceClient $serviceClient): self
    {
        $this->serviceClient = $serviceClient;
        return $this;
    }

    // Additional Methods

    public function markAsResolved(): void
    {
        $this->status = 'Resolved';
    }

    public function markAsRejected(): void
    {
        $this->status = 'Rejected';
    }

    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }

    public function getComplaintSummary(): string
    {
        return sprintf(
            "Complaint #%d - %s (Status: %s)",
            $this->id,
            $this->service,
            $this->status
        );
    }
}