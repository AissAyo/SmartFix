<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity] 
#[ORM\Table(name: "car_rental_services")]  
class CarRentalService extends Garagiste implements UserInterface
{
   

    #[ORM\Column(type: 'string', length: 255)]
    protected string $contactInfo;

    #[ORM\Column(type: 'string', length: 255)]
    private string $serviceMail;

    #[ORM\Column(type: 'string', length: 255)]
    private string $serviceName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $serviceLocation;

    #[ORM\Column(type: 'string', length: 255)]
    private string $serviceHours;

    #[ORM\OneToMany(targetEntity: Car::class, mappedBy: 'carRentalService')]
    private Collection $cars;

    #[ORM\OneToMany(targetEntity: VerifiedClient::class, mappedBy: 'carRentalService')]
    private Collection $verifiedClients;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'service')]
    private Collection $vehicules;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->verifiedClients = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
    }

    

    public function getContactInfo(): string
    {
        return $this->contactInfo;
    }

    public function setContactInfo(string $contactInfo): self
    {
        $this->contactInfo = $contactInfo;
        return $this;
    }

    public function getServiceMail(): string
    {
        return $this->serviceMail;
    }

    public function setServiceMail(string $serviceMail): self
    {
        $this->serviceMail = $serviceMail;
        return $this;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function setServiceName(string $serviceName): self
    {
        $this->serviceName = $serviceName;
        return $this;
    }

    public function getServiceLocation(): string
    {
        return $this->serviceLocation;
    }

    public function setServiceLocation(string $serviceLocation): self
    {
        $this->serviceLocation = $serviceLocation;
        return $this;
    }

    public function getServiceHours(): string
    {
        return $this->serviceHours;
    }

    public function setServiceHours(string $serviceHours): self
    {
        $this->serviceHours = $serviceHours;
        return $this;
    }

    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function getVerifiedClients(): Collection
    {
        return $this->verifiedClients;
    }

    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    // Implementing the required method from UserInterface
    public function getUserIdentifier(): string
    {
        return $this->serviceMail;
    }

    // Other methods required by UserInterface
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): ?string
    {
        return null; // Assuming CarRentalService does not have a password
    }

    public function getSalt(): ?string
    {
        return null; // Not needed when using modern algorithms
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }
}
