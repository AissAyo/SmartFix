<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]

class Mechanic extends Garagiste
{


    #[ORM\OneToMany(targetEntity: garage::class, mappedBy: 'mechanic')]
    private Collection $garages;

   
    
    #[ORM\ManyToOne(targetEntity: Location::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Location $location;

    public function __construct(
        string $name,
        string $email,
        string $roles,
        ?string $password = null,
        ?string $resetToken = null,
        ?\DateTimeInterface $tokenExpiration = null,
        ?string $phoneNumber = null,
        ?string $logo = null
    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $phoneNumber, $logo);

        $this->garages = new ArrayCollection();
    }

    public function getGarages(): Collection
    {
        return $this->garages;
    }

    public function setGarages(Collection $garages): void
    {
        $this->garages = $garages;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }


}