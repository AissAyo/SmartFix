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
    private string $prix;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'service', cascade: ["persist", "remove"])]
    private Collection $vehicules;

    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: "service")]
    private Collection $critiques;

    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: "critique")]
    private Collection $comments;


    #[ORM\ManyToOne(targetEntity: CategoryService::class, inversedBy: 'services')]
    #[ORM\JoinColumn(nullable: false)]
    private CategoryService $categoryService;

    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_service')]
    private Collection $garageServices;

    public function __construct()
    {
        $this->garageServices = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, GarageService>
     */
    public function getGarageServices(): Collection
    {
        return $this->garageServices;
    }

    public function addGarageService(GarageService $garageService): static
    {
        if (!$this->garageServices->contains($garageService)) {
            $this->garageServices->add($garageService);
            $garageService->setIdService($this);
        }

        return $this;
    }

    public function removeGarageService(GarageService $garageService): static
    {
        if ($this->garageServices->removeElement($garageService)) {
            // set the owning side to null (unless already changed)
            if ($garageService->getIdService() === $this) {
                $garageService->setIdService(null);
            }
        }

        return $this;
    }
}
