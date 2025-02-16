<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ServiceClient extends User implements UserInterface
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $serviceDetails;

    public function getServiceDetails(): string
    {
        return $this->serviceDetails;
    }

    public function setServiceDetails(string $serviceDetails): self
    {
        $this->serviceDetails = $serviceDetails;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }
}