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

    #[ORM\Column(type: "string", length: 255)]
    protected string $password;

    // Other common properties and methods for User
}