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

    #[ORM\Column(type: "string", length: 255)]
    protected string $username;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    protected ?string $password = null;

    #[ORM\Column(type: "string", length: 255)]
    protected string $Email;

    // Tu peux ajouter d'autres propriétés ou méthodes ici
}
