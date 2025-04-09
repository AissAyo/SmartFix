<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: "car_rental_services")]
class CarRentalService extends Garagiste
{


    #[ORM\Column(type: 'string', length: 255)]
    private string $serviceMail;

    #[ORM\OneToMany(targetEntity: VerifiedClient::class, mappedBy: 'carRentalService')]
    private Collection $verifiedClients;

    #[ORM\OneToMany(targetEntity: CarRental::class, mappedBy: 'carRentalService')]
    private Collection $carRentals;

    public function __construct(
        string $name,
        string $email,
        string $roles,
        string $serviceMail,
        ?string $password = null,
        ?string $resetToken = null,
        ?\DateTimeInterface $tokenExpiration = null,
        ?string $phoneNumber = null,
        ?string $logo = null

    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $phoneNumber, $logo);

        $this->serviceMail = $serviceMail;
        $this->verifiedClients = new ArrayCollection();
        $this->carRentals = new ArrayCollection();
    }

public function getCarRentals(): Collection
{
    return $this->carRentals;
}

public function setCarRentals(Collection $carRentals): void
{
    $this->carRentals = $carRentals;
}

public function getVerifiedClients(): Collection
{
    return $this->verifiedClients;
}

public function setVerifiedClients(Collection $verifiedClients): void
{
    $this->verifiedClients = $verifiedClients;
}


}
