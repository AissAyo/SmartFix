<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Delivery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $address;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $deliveryDate;

    #[ORM\OneToMany(targetEntity: Or_der::class, mappedBy: 'delivery')]
    private Collection $Or_ders;

    public function __construct()
    {
        $this->deliveryDate = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getDeliveryDate(): \DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getOr_der(): Or_der
    {
        return $this->Or_der;
    }

    public function setOr_der(Or_der $Or_der): self
    {
        $this->Or_der = $Or_der;
        return $this;
    }
}