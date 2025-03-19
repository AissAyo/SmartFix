<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;



#[ORM\Entity]
#[ORM\Table(name: "clients")]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "discr", type: "string")]
#[ORM\DiscriminatorMap(["client" => Client::class, "verifiedClient" => VerifiedClient::class])]
class Client extends User
{
    #[ORM\Column(type: "boolean")]
    private bool $verificationStatus = false;

    #[ORM\Column(type: "datetime_immutable")]
    private \DateTimeImmutable $dateInscription;

    #[ORM\Column(type: "integer")]
    private int $loyaltyPoints = 0;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: "client")]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: "client")]
    private Collection $reviews;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: "client")]
    private Collection $vehicules;

    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: "client")]
    private Collection $critiques;

    #[ORM\OneToMany(targetEntity: Cart::class, mappedBy: "client")]
    private Collection $carts;

    #[ORM\OneToMany(targetEntity: Complaint::class, mappedBy: "client")]
    private Collection $complaints;

    #[ORM\Column(type: "string", length: 255, nullable: true)]

    private ?string $address = null;




    public function __construct()
    {
        $this->dateInscription = new \DateTimeImmutable();
        $this->reservations = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
        $this->critiques = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->complaints = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }

    public function isVerificationStatus(): bool
    {
        return $this->verificationStatus;
    }

    public function setVerificationStatus(bool $verificationStatus): void
    {
        $this->verificationStatus = $verificationStatus;
    }

    public function getDateInscription(): \DateTimeImmutable
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeImmutable $dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    public function getLoyaltyPoints(): int
    {
        return $this->loyaltyPoints;
    }

    public function setLoyaltyPoints(int $loyaltyPoints): void
    {
        $this->loyaltyPoints = $loyaltyPoints;
    }

    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function setReservations(Collection $reservations): void
    {
        $this->reservations = $reservations;
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function setReviews(Collection $reviews): void
    {
        $this->reviews = $reviews;
    }

    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function setVehicules(Collection $vehicules): void
    {
        $this->vehicules = $vehicules;
    }

    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function setCritiques(Collection $critiques): void
    {
        $this->critiques = $critiques;
    }

    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function setCarts(Collection $carts): void
    {
        $this->carts = $carts;
    }

    public function getComplaints(): Collection
    {
        return $this->complaints;
    }

    public function setComplaints(Collection $complaints): void
    {
        $this->complaints = $complaints;
    }


}