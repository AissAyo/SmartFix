<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'mechanics')]
class Mechanic extends Garagiste
{
    #[ORM\Column(type: 'string', length: 20)]
    private string $status;


    #[ORM\OneToMany(targetEntity: Garage::class, mappedBy: 'mechanic')]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $garage;


    #[ORM\ManyToOne(targetEntity: Location::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Location $location;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getGarage(): Collection
    {
        return $this->garage;
    }

    public function setGarage(Collection $garage): void
    {
        $this->garage = $garage;
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