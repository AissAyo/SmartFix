<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity]
#[ORM\Table(name: 'garages')]
#[Vich\Uploadable]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $emailGarage;

    #[ORM\Column(type: 'string', length: 255)]
    private string $GarageAddress;

    #[ORM\Column(type: 'float')]
    private float $rating;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $workingHours = null;

    #[ORM\Column(name: "phone_number", type: "string", length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    #[Vich\UploadableField(mapping: 'garage_logo', fileNameProperty: 'LogoProfil')]
    private ?File $LogoFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $LogoProfil = null;

    #[ORM\OneToMany(targetEntity: CategoryService::class, mappedBy: 'garage')]
    private Collection $categoryServices;

    #[ORM\ManyToOne(targetEntity: Mechanic::class, inversedBy: 'garages', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Mechanic $mechanic = null;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\OneToOne(targetEntity: Location::class, inversedBy: 'garage', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Location $location = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $City = null;

    public function __construct()
    {
        $this->categoryServices = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmailGarage(): string
    {
        return $this->emailGarage;
    }

    public function setEmailGarage(string $emailGarage): void
    {
        $this->emailGarage = $emailGarage;
    }

    public function getGarageAddress(): string
    {
        return $this->GarageAddress;
    }

    public function setGarageAddress(string $GarageAddress): void
    {
        $this->GarageAddress = $GarageAddress;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getWorkingHours(): ?string
    {
        return $this->workingHours;
    }

    public function setWorkingHours(?string $workingHours): void
    {
        $this->workingHours = $workingHours;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getLogoFile(): ?File
    {
        return $this->LogoFile;
    }

    public function setLogoFile(?File $LogoFile): void
    {
        $this->LogoFile = $LogoFile;
    }

    public function getLogoProfil(): ?string
    {
        return $this->LogoProfil;
    }

    public function setLogoProfil(?string $LogoProfil): void
    {
        $this->LogoProfil = $LogoProfil;
    }

    public function getMechanic(): ?Mechanic
    {
        return $this->mechanic;
    }

    public function setMechanic(?Mechanic $mechanic): void
    {
        $this->mechanic = $mechanic;
    }

    public function getCategoryServices(): Collection
    {
        return $this->categoryServices;
    }

    public function addCategoryService(CategoryService $categoryService): self
    {
        if (!$this->categoryServices->contains($categoryService)) {
            $this->categoryServices[] = $categoryService;
            $categoryService->setGarage($this);
        }
        return $this;
    }

    public function removeCategoryService(CategoryService $categoryService): self
    {
        if ($this->categoryServices->removeElement($categoryService)) {
            if ($categoryService->getGarage() === $this) {
                $categoryService->setGarage(null);
            }
        }
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
            $reservation->setGarage($this);
        }
        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(?string $City): void
    {
        $this->City = $City;
    }
}

