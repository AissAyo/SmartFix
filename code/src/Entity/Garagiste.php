<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

 
#[ORM\MappedSuperclass]
abstract class Garagiste extends User
{

    #[ORM\Column(type: "string", length: 255)]
    protected string $phoneNumber;

    #[ORM\Column(type: "string", length: 255)]
    protected string $workingHours;

    public function __construct(string $username, string $phoneNumber, string $workingHours, ?string $email = null, ?string $password = null)
    {
        parent::__construct($username, $email, $password);
        $this->phoneNumber = $phoneNumber;
        $this->workingHours = $workingHours;
    }
    public function getWorkingHours(): string
    {
        return $this->workingHours;
    }

    public function setWorkingHours(string $workingHours): void
    {
        $this->workingHours = $workingHours;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }


}