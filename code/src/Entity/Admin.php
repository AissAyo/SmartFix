<?php
namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Admin extends User 
{
    public function __construct(
        string             $name,
        string             $email,
        string             $roles,
        ?string            $password = null,
        ?string            $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null
    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration);
    }
}
