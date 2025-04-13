<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class MechanicServices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(targetEntity: Garage::class, mappedBy: 'mechanicServices')]
    private Collection $garages;

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'mechanicServices')]
    private Collection $services;

    #[ORM\OneToMany(targetEntity: CategoryService::class, mappedBy: 'mechanicServices')]
    private Collection $categoryServices;

    public function __construct()
    {
        $this->garages = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->categoryServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGarages(): Collection
    {
        return $this->garages;
    }

    public function setGarages(Collection $garages): void
    {
        $this->garages = $garages;
    }

    public function getServices(): Collection
    {
        return $this->services;
    }

    public function setServices(Collection $services): void
    {
        $this->services = $services;
    }

    public function getCategoryServices(): Collection
    {
        return $this->categoryServices;
    }

    public function setCategoryServices(Collection $categoryServices): void
    {
        $this->categoryServices = $categoryServices;
    }
}
