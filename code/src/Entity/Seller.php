<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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


    public function __construct()
    {
        parent::__construct(
            '',        // name
            '',        // email
            'ROLE_SELLER', // roles
            null,      // password
            null,      // resetToken
            null,      // tokenExpiration
            null,      // phoneNumber
            null,      // logo
            null       // workingHours
        );
        $this->contactInfo = '';
        $this->shops = new ArrayCollection();
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
