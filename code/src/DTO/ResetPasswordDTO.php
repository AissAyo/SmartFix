<?php
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ResetPasswordDTO
{
    /**
     * @Assert\NotBlank(message="Veuillez entrer un mot de passe.")
     * @Assert\Length(
     *     min=8,
     *     minMessage="Le mot de passe doit contenir au moins {{ limit }} caractères."
     * )
     */
    private ?string $password = null;

    /**
     * @Assert\NotBlank(message="Veuillez confirmer votre mot de passe.")
     * @Assert\EqualTo(
     *     propertyPath="password",
     *     message="Les deux mots de passe doivent correspondre."
     * )
     */
    private ?string $confirmPassword = null;

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(?string $confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }
}
