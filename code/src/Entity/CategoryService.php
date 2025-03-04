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
    private int $Id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $categoryDescription;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'categoryService')]
    private Collection $services;

    #[ORM\ManyToOne(targetEntity: Mechanic::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Garagiste $mechanic;

  


    public function __construct() 
    {
        $this->services = new ArrayCollection();
    }

    // Getters and setters for the properties
}