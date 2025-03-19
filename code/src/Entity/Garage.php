<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $Id;

    #[ORM\Column(type: 'float')]
    private float $rating;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\Column(type: 'string', length: 255)]
    private string $garageName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $location;

    #[ORM\Column(type: 'string', length: 15)]
    private string $telephoneGarage;

    #[ORM\ManyToOne(targetEntity: Mechanic::class, inversedBy: 'garage')]
    private Mechanic $mechanic;


    #[ORM\ManyToMany(targetEntity: CategoryService::class, inversedBy: 'garages')]
    #[ORM\JoinTable(name: 'garage_category_service')]
    private Collection $categoryServices;

    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: 'garage')]
    private Collection $critiques;



    public function __construct()
    {
        $this->mechanics = new ArrayCollection();
        $this->categoryServices = new ArrayCollection();
    }

    // Getters and setters for the properties
    // Getter and Setter for $id
    public function getId(): int
    {
        return $this->Id;
    }
    public function setId(int $Id): self
    {
         $this->Id = $Id;
         return $this;
    }

    // Getter and Setter for $rating
    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    // Getter and Setter for $status
    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    // Getter and Setter for $name


    // Getter and Setter for $location
    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getGarageName(): string
    {
        return $this->garageName;
    }

    public function setGarageName(string $garageName): void
    {
        $this->garageName = $garageName;
    }

    public function getTelephoneGarage(): string
    {
        return $this->telephoneGarage;
    }

    public function setTelephoneGarage(string $telephoneGarage): void
    {
        $this->telephoneGarage = $telephoneGarage;
    }
}