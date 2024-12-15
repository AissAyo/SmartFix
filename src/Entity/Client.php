<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Client extends User
{
    #[ORM\Column(type: "boolean")]
    private bool $isVerified = false;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTime $verificationDate = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $verificationDocumentPath = null;

    #[ORM\Column(type: "integer")]
    private int $loyaltyPoints = 0;

    #[ORM\OneToMany(targetEntity: AppointmentHistory::class, mappedBy: "vehicleClient")]
    private $appointmentHistory;

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: "client")]
    private $reviews;

    #[ORM\ManyToMany(targetEntity: Garage::class, inversedBy: "clients")]
    private $favoriteGarages;  // Clients can have multiple favorite garages

    #[ORM\ManyToOne(targetEntity: VehicleClient::class, nullable: true)]
    private ?VehicleClient $vehicleClient = null;

    #[ORM\ManyToOne(targetEntity: Garage::class, nullable: true)]
    private ?Garage $garage = null;  // A client can be linked to a specific garage

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;
        return $this;
    }

    public function getVerificationDate(): ?\DateTime
    {
        return $this->verificationDate;
    }

    public function setVerificationDate(?\DateTime $verificationDate): self
    {
        $this->verificationDate = $verificationDate;
        return $this;
    }

    public function getVerificationDocumentPath(): ?string
    {
        return $this->verificationDocumentPath;
    }

    public function setVerificationDocumentPath(?string $path): self
    {
        $this->verificationDocumentPath = $path;
        return $this;
    }

    public function getLoyaltyPoints(): int
    {
        return $this->loyaltyPoints;
    }

    public function setLoyaltyPoints(int $loyaltyPoints): self
    {
        $this->loyaltyPoints = $loyaltyPoints;
        return $this;
    }

    public function getAppointmentHistory()
    {
        return $this->appointmentHistory;
    }

    public function setAppointmentHistory($appointmentHistory): self
    {
        $this->appointmentHistory = $appointmentHistory;
        return $this;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews): self
    {
        $this->reviews = $reviews;
        return $this;
    }

    public function getFavoriteGarages()
    {
        return $this->favoriteGarages;
    }

    public function setFavoriteGarages($favoriteGarages): self
    {
        $this->favoriteGarages = $favoriteGarages;
        return $this;
    }

    public function getVehicleClient(): ?VehicleClient
    {
        return $this->vehicleClient;
    }

    public function setVehicleClient(?VehicleClient $vehicleClient): self
    {
        $this->vehicleClient = $vehicleClient;
        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;
        return $this;
    }

    public function verifyClient(string $documentPath): self
    {
        $this->verificationDocumentPath = $documentPath;
        $this->isVerified = true;
        $this->verificationDate = new \DateTime();
        
        return $this;
    }
}

?>
