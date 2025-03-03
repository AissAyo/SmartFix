<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class GarageService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $Id;

    #[ORM\Column(type: 'float', length: 255)]
    private float $Prix;
 


    #[ORM\ManyToOne(targetEntity: garage::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Garage $garage;	

    #[ORM\ManyToOne(targetEntity: service::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Service $service;
    
    #[ORM\ManyToOne(targetEntity: CarAPI::class)]
    #[ORM\JoinColumn(nullable: false)]
    private CarAPI $carAPI;

    #[ORM\OneToMany(targetEntity: Reservatino::class, mappedBy: 'garageService')]
    private Collection $reservations;  

    public function __construct() {
        $this->garages = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->Id;
    }

    public function getPrix(): float
    {
        return $this->Prix;
    }


    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;
        return $this;
    }
}    


