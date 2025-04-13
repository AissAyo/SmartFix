<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $Id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $serviceName;

    #[ORM\Column(type: 'string', length: 100)]
    private string $serviceCode;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $prix;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;


    #[ORM\ManyToOne(targetEntity: CategoryService::class, inversedBy: 'service')]
    #[ORM\JoinColumn(name: 'category_service_id', nullable: false)]
    private CategoryService $categoryService;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: ReservationService::class, cascade: ['persist', 'remove'])]
    private Collection $reservationServiceLinks;





    public function getId(): int 
    {
        return $this->serviceId;
    }

    public function isAvailable(): bool
    {
        return $this->status === 'ACTIVE';
    }

    public function updatePrice(float $newPrice): void
    {
        $this->prix = $newPrice;
    }
    public function setServiceName(string $serviceName): self
    {
        $this->serviceName = $serviceName;

        return $this;
    }
    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    
    public function setServiceCode(string $serviceCode): self
    {
        $this->serviceCode = $serviceCode;

        return $this;
    }
}
