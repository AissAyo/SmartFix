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

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'categoryService')]
    private Collection $services;

    #[ORM\ManyToMany(targetEntity: Garage::class, inversedBy: 'categoryServices')]
    #[ORM\JoinTable(name: 'garageCategoryService')] // Define join table directly
    private Collection $garages;

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

    public function setServices(Collection $services): void
    {
        $this->services = $services;
    }

    public function getCategoryname(): string
    {
        return $this->Categoryname;
    }

    public function setCategoryname(string $Categoryname): void
    {
        $this->Categoryname = $Categoryname;
    }

}
