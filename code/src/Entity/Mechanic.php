<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]

class Mechanic extends Garagiste implements UserInterface
{
    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\Column(type: 'string', length: 15)]
    private string $telephoneGarage;

    #[ORM\Column(type: 'string', length: 255)]
    private string $garageEmail;


    #[ORM\ManyToOne(targetEntity: Role::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Role $role;

    // Implementing the required method from UserInterface
    public function getUserIdentifier(): string
    {
        return $this->garageEmail;
    }

    // Other methods required by UserInterface
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): ?string
    {
        return null; // Assuming Mechanic does not have a password
    }

    public function getSalt(): ?string
    {
        return null; // Not needed when using modern algorithms
    }

    public function eraseCredentials() : void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    // Additional properties and methods specific to Mechanic can be added here
}