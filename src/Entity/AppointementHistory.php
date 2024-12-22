<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AppointmentHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "datetime")]
    private \DateTime $appointmentDate;

    #[ORM\Column(type: "string", length: 100)]
    private string $status; // e.g. "pending", "completed", "canceled"

    #[ORM\ManyToOne(targetEntity: VehicleClient::class, inversedBy: "appointmentHistory")]
    #[ORM\JoinColumn(nullable: false)]
    private VehicleClient $vehicleClient;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: "appointmentHistory")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAppointmentDate(): \DateTime
    {
        return $this->appointmentDate;
    }

    public function setAppointmentDate(\DateTime $appointmentDate): self
    {
        $this->appointmentDate = $appointmentDate;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getVehicleClient(): VehicleClient
    {
        return $this->vehicleClient;
    }

    public function setVehicleClient(VehicleClient $vehicleClient): self
    {
        $this->vehicleClient = $vehicleClient;
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
