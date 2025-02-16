<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $Id;

    #[ORM\Column(type: 'float')]
    private float $rating;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $location;

    #[ORM\OneToMany(targetEntity: Mechanic::class, mappedBy: 'garage')]
    private Collection $mechanics;

    #[ORM\OneToMany(targetEntity: CategoryService::class, mappedBy: 'garage')]
    private Collection $categoryServices;

    public function __construct()
    {
        $this->mechanics = new ArrayCollection();
        $this->categoryServices = new ArrayCollection();
    }

    // Getters and setters for the properties
}