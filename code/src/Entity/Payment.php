<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $method;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $paymentDate;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private String $amount;

    #[ORM\Column(type: 'string', length: 3)]
    private string $currency;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $transactionId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $paymentGateway;

    #[ORM\OneToOne(targetEntity: Or_der::class, inversedBy: 'payment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Or_der $Or_der = null;

    public function __construct()
    {
        $this->paymentDate = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function getPaymentDate(): \DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

// Setter
    public function setAmount(string $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
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

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function setTransactionId(string $transactionId): self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getPaymentGateway(): string
    {
        return $this->paymentGateway;
    }

    public function setPaymentGateway(string $paymentGateway): self
    {
        $this->paymentGateway = $paymentGateway;
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