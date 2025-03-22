<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "sellers")]
class Seller extends Garagiste
{
    #[ORM\Column(type: "string", length: 255)]
    protected string $contactInfo;

    #[ORM\OneToMany(targetEntity: Shop::class, mappedBy: 'seller')]
    private Collection $shops;


    public function __construct(
        string $name,
        string $email,
        string $contactInfo,
        string $roles = "Seller",
        ?string $password = null,
        ?string $resetToken = null,
        ?\DateTimeInterface $tokenExpiration = null,
        ?string $phoneNumber = null,
        ?string $logo = null,
        ?string $workingHours = null
    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $phoneNumber ,$logo,$workingHours);

        $this->contactInfo = $contactInfo;
    }

    public function getContactInfo(): string
    {
        return $this->contactInfo;
    }

    public function setContactInfo(string $contactInfo): void
    {
        $this->contactInfo = $contactInfo;
    }

    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function setShops(Collection $shops): void
    {
        $this->shops = $shops;
    }


}
