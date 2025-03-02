<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "cars")]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $model;

    #[ORM\Column(type: "string", length: 255)]
    private string $brand;

    #[ORM\Column(type: "boolean", length: 255)]
    private bool $Status;

    #[ORM\Column(type: "float", length: 255)]
    private float $DailyRate;


    #[ORM\ManyToOne(targetEntity: CarRentalService::class, inversedBy: "cars")]
    #[ORM\JoinColumn(nullable: false)]
    private CarRentalService $carRentalService;
    
    #[ORM\OneToMany(targetEntity: Rental::class, mappedBy: "car")]
    private Collection $rentals;


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

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }
    public function getDailyRate(): float
    {
        return $this->DailyRate;
    }
    public function setDailyrate(float $DailyRate): self
    {
        $this->DailyRate = $DailyRate;
        return $this;
    }
    public function getStatus(): bool
    {
        return $this->Status;
    }
    public function setStatus(bool $Status): self
    {
        $this->Status = $Status;
        return $this;
    }
}