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
    private int $id;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\ManyToOne(targetEntity: Garage::class, inversedBy: 'garageServices')]
    #[ORM\JoinColumn(nullable: false)]
    private Garage $garage;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'garageServices')]
    #[ORM\JoinColumn(nullable: false)]
    private Service $service;

    #[ORM\ManyToOne(targetEntity: CarAPI::class, inversedBy: 'garageServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CarAPI $carAPI = null;

 

    
    #[ORM\ManyToMany(targetEntity: Reservation::class, inversedBy: 'garageServices')]
    #[ORM\JoinTable(name: 'garage_service_reservation')]
    private Collection $reservations;
 
    public function __construct()
    {
        $this->carAPIs = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrix(): float
    {
        return $this->price;
    }

    public function setPrix(float $price): self
    {
        $this->price = $price;
        return $this;
    }
}
