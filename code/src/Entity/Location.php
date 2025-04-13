<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $address;

    #[ORM\Column(type: 'float')]
    private float $longitude;

    #[ORM\Column(type: 'float')]
    private float $latitude;

    #[ORM\OneToOne(targetEntity: Garage::class, mappedBy: 'location')]
    private ?Garage $garage = null;





    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;
        return $this;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

}