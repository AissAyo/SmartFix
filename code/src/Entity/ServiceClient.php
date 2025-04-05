<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ServiceClient extends User
{

    
    #[ORM\Column(type: 'string', length: 255)]
    private string $serviceDetails;

    #[ORM\OneToMany(targetEntity: Complaint::class, mappedBy: "serviceClient")]
    private Collection $complaints;


    public function __construct(
        string $name,
        string $email,
        string $roles,
        ?string $password ,
        ?string $resetToken ,
        ?\DateTimeInterface $tokenExpiration ,
        ?string $phoneNumber ,
        ?string $logo ,
        string $serviceDetails
    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $phoneNumber, $logo);

        $this->complaints = new ArrayCollection();

        $this->serviceDetails = $serviceDetails;
    }
    public function getServiceDetails(): string
    {
        return $this->serviceDetails;
    }

    public function setServiceDetails(string $serviceDetails): void
    {
        $this->serviceDetails = $serviceDetails;
    }

    public function getComplaints(): Collection
    {
        return $this->complaints;
    }

    public function setComplaints(Collection $complaints): void
    {
        $this->complaints = $complaints;
    }


}