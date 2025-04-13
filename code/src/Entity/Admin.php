<?php
namespace App\Entity;

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Admin extends User
{
    public function __construct(
        string             $name = '',
        string             $email = '',
        string             $roles = '',
        ?string            $adress = null,
        ?string            $city = '',
        ?string            $password = null,
        ?string            $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string            $phone = null,
        ?string            $photoProfil = "avatar5-67f2b22f9551d.png"
    ) {
        parent::__construct(
            $name,
            $email,
            $adress,
            $city,
            $roles,
            $password,
            $resetToken,
            $tokenExpiration,
            $phone,
            $photoProfil
        );
    }
}

