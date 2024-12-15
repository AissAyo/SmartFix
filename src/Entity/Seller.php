<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Seller extends User
{
    #[ORM\Column(type: "string", length: 255)]
    private string $businessName;

    #[ORM\Column(type: "string", length: 255)]
    private string $contactNumber;

    #[ORM\Column(type: "string", length: 255)]
    private string $address;

    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: "seller")]
    private $products;  // Seller has products to sell

    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    public function setBusinessName(string $businessName): self
    {
        $this->businessName = $businessName;
        return $this;
    }

    public function getContactNumber(): string
    {
        return $this->contactNumber;
    }

    public function setContactNumber(string $contactNumber): self
    {
        $this->contactNumber = $contactNumber;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts($products): self
    {
        $this->products = $products;
        return $this;
    }
}

?>
