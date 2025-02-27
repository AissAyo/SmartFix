<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: "admins")] // Spécifie le nom de la table
class Admin extends User implements UserInterface
{
    #[ORM\Column(type: "string", length: 255)]
    private string $username;

    #[ORM\Column(type: "json")]
    private array $roles = [];

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

    public function eraseCredentials(): void
    {
        // $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }
}
