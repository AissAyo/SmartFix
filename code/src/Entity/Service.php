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


    #[ORM\ManyToOne(targetEntity: CategoryService::class, inversedBy: 'services')]
    #[ORM\JoinColumn(name: 'category_service_id', nullable: false)]
    private CategoryService $categoryService;
    

<<<<<<< HEAD
    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_service')]
    private Collection $garageServices;

    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_service')]
    private Collection $id_garage;

    public function __construct()
    {
        $this->garageServices = new ArrayCollection();
        $this->id_garage = new ArrayCollection();
    }

    public function getId(): int
=======
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'service')]
    private Collection $garageServices;


    public function getId(): int 
>>>>>>> feature/HomeAyoub
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
<<<<<<< HEAD

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

    public function removeIdGarage(GarageService $idGarage): static
    {
        if ($this->id_garage->removeElement($idGarage)) {
            // set the owning side to null (unless already changed)
            if ($idGarage->getIdService() === $this) {
                $idGarage->setIdService(null);
            }
        }
=======
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    
    public function setServiceCode(string $serviceCode): self
    {
        $this->serviceCode = $serviceCode;
>>>>>>> feature/HomeAyoub

        return $this;
    }
}
