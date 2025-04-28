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
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $Categoryname;

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'categoryService', cascade: ['persist', 'remove'])]
    private Collection $services;

    #[ORM\ManyToOne(targetEntity: Garage::class, inversedBy: 'categoryServices', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Garage $garage = null;

    public function __construct() 
    {
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setCategoryService($this);
        }
        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getCategoryService() === $this) {
                $service->setCategoryService(null);
            }
        }
        return $this;
    }

    public function getCategoryname(): string
    {
        return $this->Categoryname;
    }

    public function setCategoryname(string $Categoryname): self
    {
        $this->Categoryname = $Categoryname;
        return $this;
    }

    public function setGarage(Garage $garage): self
    {
        $this->garage = $garage;
        $garage->addCategoryService($this);
        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
