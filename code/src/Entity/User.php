<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\MappedSuperclass]
#[Vich\Uploadable]
abstract class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $email;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $logo = null;

    #[Vich\UploadableField(mapping: 'seller_logo', fileNameProperty: 'logo')]
    private ?File $logoFile = null;

    #[ORM\Column(type: "json")]
    private string $roles;
    

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $tokenExpiration = null;

    public function __construct(
        string $name,
        string $email,
        string $roles,
        ?string $password = null,
        ?string $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string $logo = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
        $this->resetToken = $resetToken;
        $this->tokenExpiration = $tokenExpiration;
        $this->logo=$logo;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function setLogoFile(?File $logoFile): void
    {
        $this->logoFile = $logoFile;
    }
}
