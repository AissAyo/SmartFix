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

    #[ORM\Column(type: "string", length: 20)]
    private string $status;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $estimatedPrice;

    #[ORM\ManyToOne(targetEntity: Vehicule::class, inversedBy: "reservations", cascade: ['persist'])]
    private Vehicule $vehicle;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private Service $service;

    #[ORM\OneToMany(targetEntity: RepairPart::class, mappedBy: 'reservation')]
    private Collection $repairParts;

    #[ORM\OneToOne(targetEntity: Critique::class, mappedBy: 'reservation')]
    private ?Critique $critique = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="reservation", orphanRemoval=true)
     */
    private $reviews;

    public function __construct()
    {
        $this->repairParts = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->service = new Service(); // placeholder to satisfy typed property
        $this->reviews = new ArrayCollection();
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
            $this->repairParts->add($repairPart);
            $repairPart->setReservation($this);
        }

        return $this;
    }

    public function removeRepairPart(RepairPart $repairPart): self
    {
        if ($this->repairParts->removeElement($repairPart)) {
            // set the owning side to null (unless already changed)
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

    public function getService(): Service
    {
        return $this->service;
    }

    public function setService(Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setReservation($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getReservation() === $this) {
                $review->setReservation(null);
            }
        }

        return $this;
    }
}
