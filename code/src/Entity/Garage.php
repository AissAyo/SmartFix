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

    #[ORM\ManyToOne(targetEntity: Mechanic::class, inversedBy: 'garages')]
    #[ORM\JoinColumn(nullable: false)]
    private Mechanic $mechanic;

    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'garage')]
    private Collection $garageServices;


    #[ORM\OneToOne(targetEntity: Location::class, inversedBy: 'garage')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;


    /**
     * @var Collection<int, GarageService>
     */

    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_garage')]
    private Collection $service;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;



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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

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

    public function getGarageServices(): Collection
    {
        return $this->garageServices;
    }

    public function setGarageServices(Collection $garageServices): void
    {
        $this->garageServices = $garageServices;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return Collection<int, GarageService>
     */


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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

}