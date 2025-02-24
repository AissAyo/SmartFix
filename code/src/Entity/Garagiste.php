<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

 
#[ORM\MappedSuperclass]
abstract class Garagiste extends User
{
   

    #[ORM\Column(type: "string", length: 255)]
    private string $garageName;

    #[ORM\Column(type: "string", length: 255)]
    private string $garageAddress;

    #[ORM\Column(type: "string", length: 255)]
    private string $phoneNumber;

    #[ORM\Column(type: "string", length: 255)]
    protected string $workingHours;
}