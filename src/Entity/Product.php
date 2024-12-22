<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;  // Name of the product

    #[ORM\Column(type: "text")]
    private string $description;  // Detailed description of the product

    #[ORM\Column(type: "float")]
    private float $price;  // Price of the product

    #[ORM\Column(type: "string", length: 100)]
    private string $category;  // Product category (e.g., "Engine Parts", "Tires", "Accessories")

    #[ORM\ManyToOne(targetEntity: Seller::class, inversedBy: "products")]
    #[ORM\JoinColumn(nullable: false)]
    private Seller $seller;  // Each product is linked to a specific seller

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getSeller(): Seller
    {
        return $this->seller;
    }

    public function setSeller(Seller $seller): self
    {
        $this->seller = $seller;
        return $this;
    }
}

?>
