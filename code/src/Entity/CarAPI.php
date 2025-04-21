<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "car_api")]
class CarAPI
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $make;

    #[ORM\Column(type: 'string', length: 100)]
    private string $model;

    #[ORM\Column(type: 'integer')]
    private int $year;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $trim = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $horsepower = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $torque = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $engine = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $fuelType = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $transmission = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $drivetrain = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $bodyType = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $doors = null;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'carAPI')]
    private Collection $vehicles;

    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
    }

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;
        return $this;
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

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getTrim(): ?string
    {
        return $this->trim;
    }

    public function setTrim(?string $trim): self
    {
        $this->trim = $trim;
        return $this;
    }

    public function getHorsepower(): ?int
    {
        return $this->horsepower;
    }

    public function setHorsepower(?int $horsepower): self
    {
        $this->horsepower = $horsepower;
        return $this;
    }

    public function getTorque(): ?int
    {
        return $this->torque;
    }

    public function setTorque(?int $torque): self
    {
        $this->torque = $torque;
        return $this;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(?string $engine): self
    {
        $this->engine = $engine;
        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function setFuelType(?string $fuelType): self
    {
        $this->fuelType = $fuelType;
        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(?string $transmission): self
    {
        $this->transmission = $transmission;
        return $this;
    }

    public function getDrivetrain(): ?string
    {
        return $this->drivetrain;
    }

    public function setDrivetrain(?string $drivetrain): self
    {
        $this->drivetrain = $drivetrain;
        return $this;
    }

    public function getBodyType(): ?string
    {
        return $this->bodyType;
    }

    public function setBodyType(?string $bodyType): self
    {
        $this->bodyType = $bodyType;
        return $this;
    }

    public function getDoors(): ?int
    {
        return $this->doors;
    }

    public function setDoors(?int $doors): self
    {
        $this->doors = $doors;
        return $this;
    }

    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicule $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles->add($vehicle);
            $vehicle->setCarAPI($this);
        }
        return $this;
    }

    public function removeVehicle(Vehicule $vehicle): self
    {
        if ($this->vehicles->removeElement($vehicle)) {
            if ($vehicle->getCarAPI() === $this) {
                $vehicle->setCarAPI(null);
            }
        }
        return $this;
    }
}
