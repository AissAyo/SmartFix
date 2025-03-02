<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
class Admin extends User 
{
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    

    public function getUserIdentifier(): string
    {
        return $this->username;
    }
    public function getEmail(): string
    {
        return $this->Email;
    }
    public function setEmail(string $Email): self
    {
        $this->Email = $Email;
        return $this;
    }
}
