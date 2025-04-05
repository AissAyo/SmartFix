<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $totalAmount;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'carts')]
    #[ORM\JoinTable(name: 'cart_products')]
    private Collection $products;

    #[ORM\OneToOne(targetEntity: Client::class, inversedBy: 'cart')]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\OneToOne(targetEntity: Or_der::class, mappedBy: 'cart')]
    private ?Or_der $Or_der = null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTotalAmount(): string
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(string $totalAmount): self
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addCart($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeCart($this);
        }

        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function getOr_der(): ?Or_der
    {
        return $this->Or_der;
    }

    public function setOr_der(?Or_der $Or_der): self
    {
        $this->Or_der = $Or_der;
        return $this;
    }
}