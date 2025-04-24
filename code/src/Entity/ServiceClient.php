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

    #[ORM\OneToMany(targetEntity: Conversation::class, mappedBy: 'serviceClient')]
    private Collection $conversations;


    public function __construct(
        string $name,
        string $email,
        string $roles,
        ?string $password = null,
        ?string $resetToken = null,
        ?\DateTimeInterface $tokenExpiration = null,
        ?string $phone = null,
        ?string $photoProfil = null
    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $phone, $photoProfil);

        $this->complaints = new ArrayCollection();
        $this->conversations = new ArrayCollection();
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

    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations->add($conversation);
            $conversation->setServiceClient($this);
        }
        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            if ($conversation->getServiceClient() === $this) {
                $conversation->setServiceClient(null);
            }
        }
        return $this;
    }
}