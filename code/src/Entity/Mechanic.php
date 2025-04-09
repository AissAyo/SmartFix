<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]

class Mechanic extends Garagiste
{

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(max: 100)]
    private ?string $specialization = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Range(min: 0, max: 50)]
    private ?int $experienceYears = null;


    public function __construct(
        string $name = '',
        string $email = '',
        string $roles = 'ROLE_MECHANIC', // Default role for mechanics
        ?string $password = null,
        ?string $resetToken = null,
        ?\DateTimeInterface $tokenExpiration = null,
        ?string $phoneNumber = null,
        ?string $logo = null,
        ?string $workingHours = null,
        // Mechanic-specific properties:
        ?string $specialization = null,
        ?int $experienceYears = null,
        ?array $certifications = null
    ) {
        parent::__construct(
            $name,
            $email,
            $roles,
            $password,
            $resetToken,
            $tokenExpiration,
            $phoneNumber, // This now goes to parent
            $logo,
            $workingHours
        );

        // Initialize Mechanic-specific properties
        $this->garages = new ArrayCollection();
        $this->specialization = $specialization;
        $this->experienceYears = $experienceYears;
        $this->certifications = $certifications ?? [];
    }
    public function getGarages(): Collection
    {
        return $this->garages;
    }

    public function setGarages(Collection $garages): void
    {
        $this->garages = $garages;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(?string $specialization): void
    {
        $this->specialization = $specialization;
    }

    public function getExperienceYears(): ?int
    {
        return $this->experienceYears;
    }

    public function setExperienceYears(?int $experienceYears): void
    {
        $this->experienceYears = $experienceYears;
    }

    public function getCertifications(): array
    {
        return $this->certifications;
    }

    public function setCertifications(array $certifications): void
    {
        $this->certifications = $certifications;
    }


}