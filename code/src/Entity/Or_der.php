<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Or_der
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $Or_derDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deliveryDate;

    #[ORM\OneToOne(targetEntity: Cart::class, inversedBy: 'Or_der')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $cart = null; 

    #[ORM\OneToOne(targetEntity: Payment::class, mappedBy: 'Or_der')]
    private ?Payment $payment = null;


    #[ORM\ManyToOne(targetEntity: Delivery::class, inversedBy: 'Or_ders')]
    #[ORM\JoinColumn(nullable: false)]
    private Delivery $delivery;

    

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->Or_derDate = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getOr_derDate(): \DateTimeInterface
    {
        return $this->Or_derDate;
    }

    public function setOr_derDate(\DateTimeInterface $Or_derDate): self
    {
        $this->Or_derDate = $Or_derDate;
        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function setCart(Cart $cart): self
    {
        $this->cart = $cart;
        return $this;
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }

    public function setPayment(Payment $payment): self
    {
        $this->payment = $payment;
        return $this;
    }

    public function getDelivery(): Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(Delivery $delivery): self
    {
        $this->delivery = $delivery;
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
            $product->setOr_der($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getOr_der() === $this) {
                $product->setOr_der(null);
            }
        }

        return $this;
    }
}