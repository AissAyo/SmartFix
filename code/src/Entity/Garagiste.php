<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\MappedSuperclass]
abstract class Garagiste extends User
{
    
    public function __construct(
        string             $name = '',
        string             $email = '',
        ?string            $address = '',
        string             $roles = '',
        ?string            $password = null,
        ?string            $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string            $phone = null,
        ?string            $logo = null,
        ?string            $workingHours = null,
        ?string            $city = null,
    ) {
        parent::__construct(
            $name,
            $email,
            $address,        
            $roles,
            $password,
            $resetToken,
            $tokenExpiration,
            $phone,
            $city
        );

        $this->workingHours = $workingHours;
        $this->city = $city;
    }

    public function getWorkingHours(): ?string
    {
        return $this->workingHours;
    }

    public function setWorkingHours(?string $workingHours): void
    {
        $this->workingHours = $workingHours;
    }



    public function getGarageAddress(): ?string
    {
        return $this->garageAddress;
    }

    public function setGarageAddress(?string $garageAddress): void
    {
        $this->garageAddress = $garageAddress;
    }


}