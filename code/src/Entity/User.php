<?php

namespace App\Entity;
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\MappedSuperclass]
abstract class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected int $id;
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    protected ?string $password = null;

    #[ORM\Column(type: "string", length: 255)]
    protected string $Email;

    
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
    public function eraseCredentials() :void 
    {
    }
}
