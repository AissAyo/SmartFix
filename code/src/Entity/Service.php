<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "services")]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private string $price;

    #[ORM\Column(type: "string", length: 20)]
    private string $status;

    #[ORM\ManyToOne(targetEntity: CategoryService::class, inversedBy: 'services', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private CategoryService $categoryService;

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'service')]
    private Collection $reservations;
    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_service')]
    private Collection $garageServices;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }
    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_service')]
    private Collection $id_garage;

    public function getId(): int
    {
        return $this->id;
    }

    public function isAvailable(): bool
    {
        return $this->status === 'ACTIVE';
    }

    public function updatePrice(float $newPrice): void
    {
        $this->price = $newPrice;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCategoryService(): CategoryService
    {
        return $this->categoryService;
    }

    public function setCategoryService(CategoryService $categoryService): self
    {
        $this->categoryService = $categoryService;
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

    /**
     * @return Collection<int, GarageService>
     */
    public function getIdGarage(): Collection
    {
        return $this->id_garage;
    }

    public function addIdGarage(GarageService $idGarage): static
    {
        if (!$this->id_garage->contains($idGarage)) {
            $this->id_garage->add($idGarage);
            $idGarage->setIdService($this);
        }

        return $this;
    }


    public function getServiceCode(): string
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setService($this);
        }
        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getService() === $this) {
                $reservation->setService(null);
            }
        }
        return $this;
    }
}
