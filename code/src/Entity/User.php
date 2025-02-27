<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\DBAL\Types\Types;




#[ORM\MappedSuperclass]
abstract class User implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected int $id;
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    protected ?string $password = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tokenExpiration = null;
    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): static
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    public function getTokenExpiration(): ?\DateTimeInterface
    {
        return $this->tokenExpiration;
    }

    public function setTokenExpiration(?\DateTimeInterface $tokenExpiration): static
    {
        $this->tokenExpiration = $tokenExpiration;

        return $this;
    }

    // Récupérer l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Définir l'ID
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    // Other common properties and methods for User
}
