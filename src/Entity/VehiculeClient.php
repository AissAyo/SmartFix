<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VehicleClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $vehicleModel;

    #[ORM\Column(type: "string", length: 50)]
    private string $vehicleRegistration;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: "vehicleClient")]
    private Client $client;

    #[ORM\OneToMany(targetEntity: AppointmentHistory::class, mappedBy: "vehicleClient")]
    private $appointmentHistory;

    public function getId(): int
    {
        return $this->id;
    }

    public function getVehicleModel(): string
    {
        return $this->vehicleModel;
    }

    public function setVehicleModel(string $vehicleModel): self
    {
        $this->vehicleModel = $vehicleModel;
        return $this;
    }

    public function getVehicleRegistration(): string
    {
        return $this->vehicleRegistration;
    }

    public function setVehicleRegistration(string $vehicleRegistration): self
    {
        $this->vehicleRegistration = $vehicleRegistration;
        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }
}

?>
