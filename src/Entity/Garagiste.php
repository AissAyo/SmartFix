<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Garagiste extends User
{
    #[ORM\Column(type: "string", length: 255)]
    private string $garageName;  // Name of the garage or mechanic

    #[ORM\Column(type: "string", length: 255)]
    private string $specialization;  // Specialization (e.g., "Auto Parts", "Car Repair")

    #[ORM\Column(type: "string", length: 255)]
    private string $location;  // Location of the garage

    #[ORM\Column(type: "datetime")]
    private \DateTime $workingHoursStart;  // Start time for working hours

    #[ORM\Column(type: "datetime")]
    private \DateTime $workingHoursEnd;  // End time for working hours

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: "garagiste")]
    private $reviews;  // Many reviews can be linked to a Garagiste

    #[ORM\OneToMany(targetEntity: AppointmentHistory::class, mappedBy: "garage")]
    private $appointments;  // Many appointments can be linked to a Garagiste

    public function getGarageName(): string
    {
        return $this->garageName;
    }

    public function setGarageName(string $garageName): self
    {
        $this->garageName = $garageName;
        return $this;
    }

    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    public function setSpecialization(string $specialization): self
    {
        $this->specialization = $specialization;
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

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews): self
    {
        $this->reviews = $reviews;
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
