<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: "sellers")]
class Seller extends Garagiste implements UserInterface
{
    #[ORM\Column(type: "string", length: 255)]
    protected string $contactInfo;

    #[ORM\Column(type: "string", length: 255)]
    private string $shopName;

    #[ORM\Column(type: "string", length: 255)]
    private string $shopEmail;

    #[ORM\Column(type: "string", length: 15)]
    private string $shopPhone;

    #[ORM\OneToMany(targetEntity: Shop::class, mappedBy: 'sellers')]
    private Collection $shops;

    #[ORM\Column(type: "string", length: 255)]
    private string $role;

    // Getter and setter methods

    public function getWorkingHours(): string
    {
        return $this->workingHours;
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

    public function getShopEmail(): string
    {
        return $this->shopEmail;
    }

    public function setShopEmail(string $shopEmail): self
    {
        $this->shopEmail = $shopEmail;
        return $this;
    }

    public function getshopName(): Shop
    {
        return $this->shop;
    }

    public function setshopName(Shop $shop): self
    {
        $this->shop = $shop;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    // Implementing the required method from UserInterface
    public function getUserIdentifier(): string
    {
        return $this->shopEmail;
    }

    // Other methods required by UserInterface
    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getPassword(): ?string
    {
        return null; // Assuming Seller does not have a password
    }

    public function getSalt(): ?string
    {
        return null; // Not needed when using modern algorithms
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    // Ensure method signatures match the parent class
    public function setWorkingHours(?string $workingHours): self
    {
        $this->workingHours = $workingHours;
        return $this;
    }
}
