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
    private int $Id;

    #[ORM\Column(type: 'float')]
    private float $rating;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $location;

    #[ORM\ManyToOne(targetEntity: Mechanic::class, inversedBy: 'garages')]
    #[ORM\JoinColumn(nullable: false)]
    private Mechanic $mechanic;

    #[ORM\ManyToMany(targetEntity: CategoryService::class, inversedBy: 'garages')]
    #[ORM\JoinTable(name: 'garage_category_service')]
    private Collection $categoryServices;

    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: 'garages')]
    private Collection $critiques;

    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_garage')]
    private Collection $garageServices;

    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_garage')]
    private Collection $service;



    public function __construct()
    {
        $this->mechanics = new ArrayCollection();
        $this->categoryServices = new ArrayCollection();
        $this->garageServices = new ArrayCollection();
        $this->service = new ArrayCollection();
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
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

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

    /**
     * @return Collection<int, GarageService>
     */
    public function getGarageServices(): Collection
    {
        return $this->garageServices;
    }

    public function addGarageService(GarageService $garageService): static
    {
        if (!$this->garageServices->contains($garageService)) {
            $this->garageServices->add($garageService);
            $garageService->setIdGarage($this);
        }

        return $this;
    }

    public function removeGarageService(GarageService $garageService): static
    {
        if ($this->garageServices->removeElement($garageService)) {
            // set the owning side to null (unless already changed)
            if ($garageService->getIdGarage() === $this) {
                $garageService->setIdGarage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GarageService>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(GarageService $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
            $service->setIdGarage($this);
        }

        return $this;
    }

    public function removeService(GarageService $service): static
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getIdGarage() === $this) {
                $service->setIdGarage(null);
            }
        }

        return $this;
    }
}