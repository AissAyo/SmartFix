<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "vehicules")]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $model;

    #[ORM\Column(type: "string", length: 255)]
    private string $brand;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Client", inversedBy: "vehicules")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\OneToMany(targetEntity: "App\Entity\Reservation", mappedBy: "vehicule")]
    private Collection $reservations;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Service", inversedBy: "vehicules")]
    #[ORM\JoinColumn(nullable: false)]
    private Service $service;

    /**
     * @var Collection<int, GarageService>
     */
    #[ORM\OneToMany(targetEntity: GarageService::class, mappedBy: 'id_voiture')]
    private Collection $garageServices;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->garageServices = new ArrayCollection();
    }

    // Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setVehicule($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getVehicule() === $this) {
                $reservation->setVehicule(null);
            }
        }

        return $this;
    }

    public function getService(): Service
    {
        return $this->service;
    }

    public function setService(Service $service): self
    {
        $this->service = $service;
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
            $garageService->setIdVoiture($this);
        }

        return $this;
    }

    public function removeGarageService(GarageService $garageService): static
    {
        if ($this->garageServices->removeElement($garageService)) {
            // set the owning side to null (unless already changed)
            if ($garageService->getIdVoiture() === $this) {
                $garageService->setIdVoiture(null);
            }
        }

        return $this;
    }
}