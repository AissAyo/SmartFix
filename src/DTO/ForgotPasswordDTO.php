<?php
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ForgotPasswordDTO
{
    /**
     * @Assert\NotBlank(message="L'adresse e-mail est obligatoire.")
     * @Assert\Email(message="Veuillez saisir une adresse e-mail valide.")
     */
    private ?string $email = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
}
