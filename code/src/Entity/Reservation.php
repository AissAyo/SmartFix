<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity]
#[ORM\Table(name: "reservations")]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $reservationDate;

    #[ORM\Column(type: "integer")]
    private int $clientId;

    #[ORM\Column(type: "string", length: 20)]
    private string $status;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $estimatedPrice;

    #[ORM\ManyToOne(targetEntity: Vehicule::class, inversedBy: "reservations")]
    private Vehicule $vehicle;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'reservations')]
    private Client $client;

    #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'reservations')]
    private Collection $services;


    #[ORM\OneToMany(targetEntity: RepairPart::class, mappedBy: 'reservation')]
    private Collection $repairParts;

    #[ORM\ManyToOne(targetEntity: Garage::class, inversedBy: 'reservations')]
    private Garage $garage;  // Change $garages to $garage

    #[ORM\OneToOne(targetEntity: Critique::class, mappedBy: 'reservation')]
    private ?Critique $critique = null;

    public function __construct()
    {
        $this->repairParts = new ArrayCollection();
        $this->garages = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getReservationDate(): \DateTimeInterface
    {
        return $this->reservationDate;
    }

    public function setReservationDate(\DateTimeInterface $reservationDate): self
    {
        $this->reservationDate = $reservationDate;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getEstimatedPrice(): string
    {
        return $this->estimatedPrice;
    }

    public function setEstimatedPrice(string $estimatedPrice): self
    {
        $this->estimatedPrice = $estimatedPrice;
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

    public function getRepairParts(): Collection
    {
        return $this->repairParts;
    }

    public function addRepairPart(RepairPart $repairPart): self
    {
        if (!$this->repairParts->contains($repairPart)) {
            $this->repairParts[] = $repairPart;
            $repairPart->setReservation($this);
        }

        return $this;
    }

    public function removeRepairPart(RepairPart $repairPart): self
    {
        if ($this->repairParts->removeElement($repairPart)) {
            if ($repairPart->getReservation() === $this) {
                $repairPart->setReservation(null);
            }
        }

        return $this;
    }

    public function getVehicle(): Vehicule
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicule $vehicle): self
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    public function getCritique(): ?Critique
    {
        return $this->critique;
    }

    public function setCritique(?Critique $critique): self
    {
        $this->critique = $critique;
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

    public function getGarage(): Garage
    {
        return $this->garage;
    }

    public function setGarage(Garage $garage): self
    {
        $this->garage = $garage;
        return $this;
    }


    public function removeGarage(Garage $garage): self
    {
        $this->garages->removeElement($garage);

        return $this;
    }



}
