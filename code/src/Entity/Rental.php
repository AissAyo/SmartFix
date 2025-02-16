<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Rental
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $rentalId;

    #[ORM\Column(type: 'integer')]
    private int $customerId;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $startDate;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $endDate;

    #[ORM\Column(type: 'float')]
    private float $totalAmount;

    #[ORM\ManyToOne(targetEntity: Car::class, inversedBy: 'rentals')]
    #[ORM\JoinColumn(nullable: false)]
    private Car $car;

    #[ORM\ManyToOne(targetEntity: Cart::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Cart $cart;

    #[ORM\ManyToOne(targetEntity: VerifiedClient::class)]
    #[ORM\JoinColumn(nullable: false)]
    private VerifiedClient $verifiedClient;

    public function getRentalId(): int
    {
        return $this->rentalId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function setCar(Car $car): self
    {
        $this->car = $car;
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

    public function getVerifiedClient(): VerifiedClient
    {
        return $this->verifiedClient;
    }

    public function setVerifiedClient(VerifiedClient $verifiedClient): self
    {
        $this->verifiedClient = $verifiedClient;
        return $this;
    }

    public function calculateTotalAmount(): void
    {
        $interval = $this->startDate->diff($this->endDate);
        $days = $interval->days;
        $this->totalAmount = $days * $this->car->getDailyRate();
    }
}