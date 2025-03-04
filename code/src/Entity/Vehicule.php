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

    #[ORM\Column(type: 'string', length: 255)]
    private string $licensePlate;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Client", inversedBy: "vehicules")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'vehicle')]
    private Collection $reservations;

    #[ORM\ManyToOne(targetEntity: CarAPI::class, inversedBy: 'vehicles')]
#[ORM\JoinColumn(nullable: false)]
private ?CarAPI $carAPI = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->carAPIs = new ArrayCollection();
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

    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }

    public function setLicensePlate(string $licensePlate): self
    {
        $this->licensePlate = $licensePlate;
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

    public function getCarAPIs(): Collection
    {
        return $this->carAPIs;
    }

    public function addCarAPI(CarAPI $carAPI): self
    {
        if (!$this->carAPIs->contains($carAPI)) {
            $this->carAPIs[] = $carAPI;
            $carAPI->setVehicle($this);
        }

        return $this;
    }

    public function removeCarAPI(CarAPI $carAPI): self
    {
        if ($this->carAPIs->removeElement($carAPI)) {
            // set the owning side to null (unless already changed)
            if ($carAPI->getVehicle() === $this) {
                $carAPI->setVehicle(null);
            }
        }

        return $this;
    }
}