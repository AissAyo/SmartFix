<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'products')]

class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\Column(type: 'string', length: 255)]
    private string $description;

    #[ORM\Column(type: 'integer')]
    private int $stockQuantity;

    #[ORM\ManyToOne(targetEntity: Shop::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private Shop $shop;

    #[ORM\ManyToOne(targetEntity: CategoryProduct::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private CategoryProduct $categoryProduct;

    #[ORM\ManyToMany(targetEntity: Cart::class, mappedBy: 'products')]
    private Collection $carts;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStockQuantity(): int
    {
        return $this->stockQuantity;
    }

    public function setStockQuantity(int $stockQuantity): void
    {
        $this->stockQuantity = $stockQuantity;
    }

    public function getShop(): Shop
    {
        return $this->shop;
    }

    public function setShop(Shop $shop): void
    {
        $this->shop = $shop;
    }

    public function getCategoryProduct(): CategoryProduct
    {
        return $this->categoryProduct;
    }

    public function setCategoryProduct(CategoryProduct $categoryProduct): void
    {
        $this->categoryProduct = $categoryProduct;
    }

    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function setCarts(Collection $carts): void
    {
        $this->carts = $carts;
    }


}