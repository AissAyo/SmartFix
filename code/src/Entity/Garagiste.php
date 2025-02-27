<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "garagistes")]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "mechanic" => Mechanic::class,
    "seller" => Seller::class,
    "car_rental_service" => CarRentalService::class,
])]
abstract class Garagiste extends User
{
   

    #[ORM\Column(type: "string", length: 255)]
    private string $garageName;

    #[ORM\Column(type: "string", length: 255)]
    private string $garageAddress;

    #[ORM\Column(type: "string", length: 255)]
    private string $phoneNumber;

    #[ORM\Column(type: "string", length: 255)]
    protected string $workingHours;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}