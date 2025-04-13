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



    #[ORM\OneToOne(targetEntity: Client::class, inversedBy: 'cart')]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;



    public function __construct()
    {
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

    public function addProduct(Product $product): void
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addCart($this);  // Assumed method in Product entity
        }
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getOrDer(): ?Or_der
    {
        return $this->orDer;
    }

    public function setOrDer(?Or_der $orDer): self
    {
        $this->orDer = $orDer;
        return $this;
    }
}
