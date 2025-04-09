<?php

namespace App\Entity;

use App\Repository\GarageServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class GarageService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'id_garage')]
    private ?Service $id_service = null;

    #[ORM\ManyToOne(inversedBy: 'service')]
    private ?garage $id_garage = null;

    #[ORM\ManyToOne(inversedBy: 'garageServices')]
    private ?vehicule $id_voiture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getIdService(): ?Service
    {
        return $this->id_service;
    }

    public function setIdService(?Service $id_service): static
    {
        $this->id_service = $id_service;

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

    public function getIdVoiture(): ?vehicule
    {
        return $this->id_voiture;
    }

    public function setIdVoiture(?vehicule $id_voiture): static
    {
        $this->id_voiture = $id_voiture;

        return $this;
    }
}
