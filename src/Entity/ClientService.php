<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ClientService extends User
{
    #[ORM\Column(type: "string", length: 255)]
    private string $serviceArea;  // Area or specialization (e.g., "Technical Support", "Billing")

    #[ORM\Column(type: "datetime")]
    private \DateTime $workingHoursStart;

    #[ORM\Column(type: "datetime")]
    private \DateTime $workingHoursEnd;

    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: "clientService")]
    private $clients;  // Clients assigned to this service representative

    public function getServiceArea(): string
    {
        return $this->serviceArea;
    }

    public function setServiceArea(string $serviceArea): self
    {
        $this->serviceArea = $serviceArea;
        return $this;
    }

    public function getWorkingHoursStart(): \DateTime
    {
        return $this->workingHoursStart;
    }

    public function setWorkingHoursStart(\DateTime $workingHoursStart): self
    {
        $this->workingHoursStart = $workingHoursStart;
        return $this;
    }

    public function getWorkingHoursEnd(): \DateTime
    {
        return $this->workingHoursEnd;
    }

    public function setWorkingHoursEnd(\DateTime $workingHoursEnd): self
    {
        $this->workingHoursEnd = $workingHoursEnd;
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
}

?>
