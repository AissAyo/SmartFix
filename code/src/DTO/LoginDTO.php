<?php
// src/DTO/LoginDTO.php
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class LoginDTO
{
    /**
     * @Assert\NotBlank(message="Veuillez entrer votre email.")
     * @Assert\Email(message="L'email n'est pas valide.")
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Veuillez entrer votre mot de passe.")
     */
    private $password;

    // Getters et setters
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}
