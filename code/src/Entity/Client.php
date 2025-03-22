<?php

namespace App\Entity;

use DateTimeInterface;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity]
#[ORM\Table(name: "clients")]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "discr", type: "string")]
#[ORM\DiscriminatorMap(["client" => Client::class, "verifiedClient" => VerifiedClient::class])]
class Client extends User
{
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $username = null;
    #[ORM\Column(type: "boolean")]
    private bool $verificationStatus = false;

    #[ORM\Column(type: "datetime_immutable")]
    private \DateTimeImmutable $dateInscription;

    #[ORM\Column(type: "integer")]
    private int $loyaltyPoints = 0;

   

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: "client")]
    private Collection $reviews;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: "client")]
    private Collection $vehicules;

    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: "client")]
    private Collection $critiques;

    #[ORM\OneToOne(targetEntity: Cart::class, mappedBy: 'client')]
    private ?Cart $cart = null;

    #[ORM\OneToMany(targetEntity: Complaint::class, mappedBy: "client")]
    private Collection $complaints;


    public function __construct(
        string             $name,
        string             $email,
        string             $roles,
        ?string            $password = null,
        ?string            $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string            $username = null
    ) {
        // Call the parent constructor (User) to initialize common properties
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration);

        // Initialize the Client-specific properties
        $this->username = $username;
        $this->dateInscription = new \DateTimeImmutable(); // Assuming the current date for inscription
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

    public function getComplaints(): Collection
    {
        return $this->complaints;
    }

    public function setComplaints(Collection $complaints): void
    {
        $this->complaints = $complaints;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }


}

