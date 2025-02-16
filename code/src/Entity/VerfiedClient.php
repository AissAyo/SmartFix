<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VerifiedClient extends Client
{
    #[ORM\Column(type: 'string', length: 20)]
    private string $cin;

    #[ORM\Column(type: 'string', length: 20)]
    private string $driversLicense;

    #[ORM\Column(type: 'string', length: 255)]
    private string $creditCardCredentials;

    #[ORM\ManyToOne(targetEntity: CarRentalService::class, inversedBy: 'verifiedClients')]
    #[ORM\JoinColumn(nullable: false)]
    private CarRentalService $carRentalService;

    public function getCin(): string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;
        return $this;
    }

    public function getDriversLicense(): string
    {
        return $this->driversLicense;
    }

    public function setDriversLicense(string $driversLicense): self
    {
        $this->driversLicense = $driversLicense;
        return $this;
    }

    public function getCreditCardCredentials(): string
    {
        return $this->creditCardCredentials;
    }

    public function setCreditCardCredentials(string $creditCardCredentials): self
    {
        $this->creditCardCredentials = $creditCardCredentials;
        return $this;
    }

    public function getCarRentalService(): CarRentalService
    {
        return $this->carRentalService;
    }

    public function setCarRentalService(CarRentalService $carRentalService): self
    {
        $this->carRentalService = $carRentalService;
        return $this;
    }
}