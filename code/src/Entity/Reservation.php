<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "reservations")]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $dateReservation;

    #[ORM\Column(type: "integer")]
    private int $clientId;

    #[ORM\Column(type: "integer")]
    private int $mecaniqueId;

    #[ORM\Column(type: "string", length: 20)]
    private string $status;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $prixEstime;


    #[ORM\Column(type: "string", length: 50)]
    private string $serviceType;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Car")]
    #[ORM\JoinColumn(nullable: false)]
    private Car $car;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: "reservations")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;	

    #[ORM\ManyToOne(targetEntity: Vehicule::class, inversedBy: "reservations")]
    #[ORM\JoinColumn(nullable: false)]
    private Vehicule $vehicule;

    // Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getDateReservation(): \DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;
        return $this;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getMecaniqueId(): int
    {
        return $this->mecaniqueId;
    }

    public function setMecaniqueId(int $mecaniqueId): self
    {
        $this->mecaniqueId = $mecaniqueId;
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

    public function getPrixEstime(): float
    {
        return $this->prixEstime;
    }

    public function setPrixEstime(float $prixEstime): self
    {
        $this->prixEstime = $prixEstime;
        return $this;
    }

    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    public function setServiceType(string $serviceType): self
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;
        return $this;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function setCar(Car $car): self
    {
        $this->car = $car;
        return $this;
    }
}
