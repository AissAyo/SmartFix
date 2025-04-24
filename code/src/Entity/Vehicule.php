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
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;


    #[ORM\Column(type: 'string', length: 100)]
    private string $ownerName;

    #[ORM\Column(type: 'string', length: 20, unique: true)]
    private string $plateNumber;

    #[ORM\Column(type: 'string', length: 50)]
    private string $color;

    #[ORM\Column(type: 'integer')]
    private int $mileage;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    private string $vin;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $registrationDate;


    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: "vehicules")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: CarAPI::class, inversedBy: "vehicles")]
    #[ORM\JoinColumn(nullable: false)]
    private CarAPI $carAPI;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'vehicle')]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }



    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    public function setOwnerName(string $ownerName): self
    {
        $this->ownerName = $ownerName;
        return $this;
    }

    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    public function setPlateNumber(string $plateNumber): self
    {
        $this->plateNumber = $plateNumber;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): self
    {
        $this->mileage = $mileage;
        return $this;
    }

    public function getVin(): string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;
        return $this;
    }

    public function getRegistrationDate(): \DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;
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

    public function getCarAPI(): CarAPI
    {
        return $this->carAPI;
    }

    public function setCarAPI(CarAPI $carAPI): self
    {
        $this->carAPI = $carAPI;
        return $this;
    }

    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setVehicle($this);
        }
        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            if ($reservation->getVehicle() === $this) {
                $reservation->setVehicle(null);
            }
        }
        return $this;
    }
}