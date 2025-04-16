<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\MappedSuperclass]
abstract class Garagiste extends User
{
    #[ORM\Column(name: "phone_number", type: "string", length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $workingHours = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $logo = null;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $garageAddress = null;


    public function __construct(
        string             $name = '',
        string             $email = '',
        ?string            $address = '',
        ?string            $city = '',
        string             $roles = '',
        ?string            $password = null,
        ?string            $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string            $phoneNumber = null,
        ?string            $logo = null,
        ?string            $workingHours = null,
        ?string            $garageAddress = null,
        ?string            $photoProfil = "avatar5-67f2b22f9551d.png"    ) {
        parent::__construct(
            $name,
            $email,
            $address,         // 👈 fix: was missing!
            $city,
            $roles,
            $password,
            $resetToken,
            $tokenExpiration,
            $phoneNumber,    // goes to User::$phone
            $logo,
            $photoProfil// goes to User::$photoProfil
        );

        $this->phoneNumber = $phoneNumber;
        $this->workingHours = $workingHours;
        $this->logo = $logo;
        $this->garageAddress = $garageAddress;
    }


    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getWorkingHours(): ?string
    {
        return $this->workingHours;
    }

    public function setWorkingHours(?string $workingHours): void
    {
        $this->workingHours = $workingHours;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
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