<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "sellers")]
class Seller extends Garagiste
{
    #[ORM\Column(type: "string", length: 255)]
    protected string $contactInfo;

    #[ORM\OneToMany(targetEntity: Shop::class, mappedBy: 'seller')]
    private Collection $shops;

    public function __construct(string $username, string $phoneNumber, string $workingHours, string $contactInfo, ?string $email = null, ?string $password = null)
    {
        parent::__construct($username, $phoneNumber, $workingHours, $email, $password);
        $this->contactInfo = $contactInfo;
        $this->shops = new ArrayCollection();
        $this->setRole("Seller"); // Assign role here
    }

    public function getContactInfo(): string
    {
        return $this->contactInfo;
    }

    public function setContactInfo(string $contactInfo): self
    {
        $this->contactInfo = $contactInfo;
        return $this;
    }

    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function setShops(Collection $shops): self
    {
        $this->shops = $shops;
        return $this;
    }


}