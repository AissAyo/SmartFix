<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Admin extends User
{
    #[ORM\Column(type: "string", length: 255)]
    private string $adminLevel;  // E.g., "SuperAdmin", "Moderator"

    public function getAdminLevel(): string
    {
        return $this->adminLevel;
    }

    public function setAdminLevel(string $adminLevel): self
    {
        $this->adminLevel = $adminLevel;
        return $this;
    }
}

?>
