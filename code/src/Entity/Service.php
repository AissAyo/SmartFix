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

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $prix;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\ManyToOne(targetEntity: CategoryService::class, inversedBy: 'services')]
    #[ORM\JoinColumn(nullable: false)]
    private CategoryService $categoryService;

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
}
