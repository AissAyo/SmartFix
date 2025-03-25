<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class RepairPart {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $Id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $partName;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $price;

    #[ORM\ManyToOne(targetEntity: Reservation::class, inversedBy: 'repairParts')]
    #[ORM\JoinColumn(nullable: false)]
    private Reservation $reservation;

    public function getId(): int
    {
        return $this->Id;
    }
    
    public function getPartName(): string
    {
        return $this->partName;
    }
    public function getPrice(): string
    {
        return $this->price;
    }
    public function setPartName(string $partName): self
    {
        $this->partName = $partName;

        return $this;
    }
    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}