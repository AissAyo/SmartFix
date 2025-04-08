<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\MappedSuperclass]
abstract class Garagiste extends User
{

    #[ORM\Column(name :"phone_number",type: "string", length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column( type: 'string', length: 255, nullable: true)]
    private ?string $workingHours = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $logo = null;


    public function __construct(
        string             $name,
        string             $email,
        string             $roles,
        ?string            $password = null,
        ?string            $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string            $phoneNumber = null,
        ?string            $logo = null,
        ?string            $workingHours = null
    ) {

        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $logo);


        $this->phoneNumber = $phoneNumber;
        $this->workingHours = $workingHours;
    }

    public function getphoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setphoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
    public function getworkingHours(): ?string
    {
    return $this->workingHours;
    }public function setworkingHours(?string $workingHours): void
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

}