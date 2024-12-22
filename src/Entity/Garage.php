<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;  // The name of the garage

    #[ORM\Column(type: "string", length: 255)]
    private string $location;  // Location of the garage

    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: "garage")]
    private $clients;  // Many clients can be linked to a garage

    #[ORM\OneToMany(targetEntity: AppointmentHistory::class, mappedBy: "garage")]
    private $appointments;  // Many appointments can be linked to a garage

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getClients()
    {
        return $this->clients;
    }

    public function setClients($clients): self
    {
        $this->clients = $clients;
        return $this;
    }

    public function getAppointments()
    {
        return $this->appointments;
    }

    public function setAppointments($appointments): self
    {
        $this->appointments = $appointments;
        return $this;
    }
}

?>
