<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
#[ORM\Entity]
#[ORM\Table(name: 'garages')]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;


    #[ORM\Column(type: 'string', length: 255)]
    private string $emailGarage;


    #[ORM\Column(type: 'float')]
    private float $rating;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $workingHours = null;

    #[ORM\ManyToMany(targetEntity: CategoryService::class, mappedBy: 'garages')]
    private Collection $categoryServices;
    #[ORM\ManyToOne(targetEntity: Mechanic::class, inversedBy: 'garages')]
    #[ORM\JoinColumn(nullable: false)]
    private Mechanic $mechanic;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $City;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'garage')]
    private Collection $reservations;
    #[ORM\OneToOne(targetEntity: Location::class, inversedBy: 'garage')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Location $location = null;


//    #[ORM\OneToMany(targetEntity: MechanicServices::class, mappedBy: 'garage')]
//    private Collection $mechanicServices;


    public function __construct()
    {
        $this->categoryServices = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    // Getters and setters for the properties
    // Getter and Setter for $id
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
         $this->id = $id;
         return $this;
    }

    public function getEmailGarage(): string
    {
        return $this->emailGarage;
    }

    public function setEmailGarage(string $emailGarage): void
    {
        $this->emailGarage = $emailGarage;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    // Getter and Setter for $status
    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    // Getter and Setter for $name
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getWorkingHours(): ?string
    {
        return $this->workingHours;
    }

    public function setWorkingHours(?string $workingHours): void
    {
        $this->workingHours = $workingHours;
    }

    public function getMechanic(): Mechanic
    {
        return $this->mechanic;
    }

    public function setMechanic(Mechanic $mechanic): void
    {
        $this->mechanic = $mechanic;
    }

    public function getCategoryServices(): Collection
    {
        return $this->categoryServices;
    }
    

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }
    public function setCity(?string $City): void
    {
        $this->City = $City;
    }
}