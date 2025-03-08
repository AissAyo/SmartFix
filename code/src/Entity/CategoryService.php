<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class CategoryService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $Categoryname;

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'category', cascade: ['persist', 'remove'])]
    private Collection $services;

<<<<<<< HEAD
    public function __construct()
=======
    #[ORM\ManyToOne(targetEntity: Mechanic::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Garagiste $mechanic;

  


    public function __construct() 
>>>>>>> b5f74be67730947e6fc0467d1ad111ea928ffcf3
    {
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryname(): string
    {
        return $this->name;
    }

    public function setCategoryname(string $Categoryname): self
    {
        $this->Categoryname = $Categoryname;
        return $this;
    }

    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setCategory($this);
        }
        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            if ($service->getCategory() === $this) {
                $service->setCategory(null);
            }
        }
        return $this;
    }
}
