<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class Garagiste extends User
{

    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column( type: 'string', length: 255, nullable: true)]
    private ?string $working_hours = null;
    #[ORM\Column(type: "string", length: 255, nullable: true)]
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
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration);

        $this->phoneNumber = $phoneNumber;
        $this->logo = $logo;
        $this->working_hours = $workingHours;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function getphone_number(): ?string
    {
        return $this->phoneNumber;
    }

    public function setphone_number(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
    public function getWorking_hours(): ?string
    {
    return $this->working_hours;
    }public function setWorking_hours(?string $working_hours): void
    {
    $this->working_hours = $working_hours;
    }

}