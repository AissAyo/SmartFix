<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected int $id;
    // Récupérer l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

// Définir l'ID
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

}