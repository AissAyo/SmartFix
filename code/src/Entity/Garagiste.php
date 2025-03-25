<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class Garagiste extends User
{

    #[ORM\Column(name :"phone_number",type: "string", length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(name: "working_hours", type: 'string', length: 255, nullable: true)]
    private ?string $working_hours = null;



    public function __construct(
        string $name = '',
        string $email = '',
        string $roles = 'ROLE_USER',
        ?string $password = null,
        ?string $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string $phoneNumber = null,
        ?string $logo = null,
        ?string $workingHours = null
    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $logo);

        $this->phoneNumber = $phoneNumber;
        $this->working_hours = $workingHours;
    }


    public function getworkingHours(): ?string
    {
    return $this->working_hours;
    }public function setworkingHours(?string $working_hours): void
    {
    $this->working_hours = $working_hours;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

}