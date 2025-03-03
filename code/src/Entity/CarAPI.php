<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class CarAPI
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $model;

    #[ORM\Column(type: 'string', length: 255)]
    private string $brand;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\Column(type: 'float')]
    private float $dailyRate;

    #[ORM\ManyToOne(targetEntity: Car::class, inversedBy: 'carAPIs')]
    #[ORM\JoinColumn(nullable: false)]
    private Car $car;

    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'carAPI')]
    private Collection $garageServices;

    #[ORM\ManyToOne(targetEntity: Vehicle::class, inversedBy: 'carAPIs')]
    #[ORM\JoinColumn(nullable: false)]
    private Vehicle $vehicle;

    public function __construct()
    {
        $this->garageServices = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
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

    public function getDailyRate(): float
    {
        return $this->dailyRate;
    }

    public function setDailyRate(float $dailyRate): self
    {
        $this->dailyRate = dailyRate;
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

    public function getGarageServices(): Collection
    {
        return $this->garageServices;
    }

    public function addGarageService(GarageService $garageService): self
    {
        if (!$this->garageServices->contains($garageService)) {
            $this->garageServices[] = $garageService;
            $garageService->setCarAPI($this);
        }

        return $this;
    }

    public function removeGarageService(GarageService $garageService): self
    {
        if ($this->garageServices->removeElement($garageService)) {
            // set the owning side to null (unless already changed)
            if ($garageService->getCarAPI() === $this) {
                $garageService->setCarAPI(null);
            }
        }

        return $this;
    }

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;
        return $this;
    }
}