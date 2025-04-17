<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\MappedSuperclass]
abstract class User implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255, nullable: true)]

    private ?string $name = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $password = null;


    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private string $email;


    // Getter et Setter pour email
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $photoProfil = null;

    #[ORM\Column(type: "string", nullable: true)]
    private string $roles;
    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $tokenExpiration = null;

    public function __construct(
        string $name = '',
        string $email = '',
        string $roles = 'ROLE_USER',
        ?string $password = null,
        ?string $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string $photoProfil = null,
        ?String $phone=null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
        $this->resetToken = $resetToken;
        $this->tokenExpiration = $tokenExpiration;
        $this->photoProfil=$photoProfil;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }



    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): self
    {
        $this->resetToken = $resetToken;
        return $this;
    }

    public function getRoles(): string
    {
        return $this->roles;
    }
    public function setRoles(string $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getTokenExpiration(): ?DateTimeInterface
    {
        return $this->tokenExpiration;
    }

    public function setTokenExpiration(?DateTimeInterface $tokenExpiration): self
    {
        $this->tokenExpiration = $tokenExpiration;
        return $this;
    }





    public function getphotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setphotoProfil(?string $photoProfil): void
    {
        $this->photoProfil = $photoProfil;
    }

    
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

}
