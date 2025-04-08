<?php

namespace App\Entity;

use App\Repository\GarageServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarageServiceRepository::class)]
class GarageService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'garageServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?garage $id_garage = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'garageServices')]
    private ?service $id_service = null;

    #[ORM\ManyToOne(inversedBy: 'garageServices')]
    private ?garage $id_garages = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getIdGarage(): ?garage
    {
        return $this->id_garage;
    }

    public function setIdGarage(?garage $id_garage): static
    {
        $this->id_garage = $id_garage;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdService(): ?service
    {
        return $this->id_service;
    }

    public function setIdService(?service $id_service): static
    {
        $this->id_service = $id_service;

        return $this;
    }

    public function getIdGarages(): ?garage
    {
        return $this->id_garages;
    }

    public function setIdGarages(?garage $id_garages): static
    {
        $this->id_garages = $id_garages;

        return $this;
    }
}
