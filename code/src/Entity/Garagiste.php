<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "garagistes")]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "discr", type: "string")]
#[ORM\DiscriminatorMap([
    "mechanic" => Mechanic::class,
    "seller" => Seller::class,
    "carRentalService" => CarRentalService::class
])]
abstract class Garagiste extends User
{
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $garageName = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $garageAddress = null;

    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $workingHours = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $logo = null;

    public function getGarageName(): ?string
    {
        return $this->garageName;
    }

    public function setGarageName(?string $garageName): self
    {
        $this->garageName = $garageName;
        return $this;
    }

    public function getGarageAddress(): ?string
    {
        return $this->garageAddress;
    }

    public function setGarageAddress(?string $garageAddress): self
    {
        $this->garageAddress = $garageAddress;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getWorkingHours(): ?string
    {
        return $this->workingHours;
    }

    public function setWorkingHours(?string $workingHours): self
    {
        $this->workingHours = $workingHours;
        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;
        return $this;
    }
}