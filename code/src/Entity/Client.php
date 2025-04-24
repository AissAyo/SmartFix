<?php

namespace App\Entity;

use DateTimeInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTimeImmutable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity]
class Client extends User
{
    #[ORM\Column(type: "boolean")]
    private bool $verificationStatus = false;

    #[ORM\Column(type: "datetime_immutable")]
    private \DateTimeImmutable $dateInscription;

    #[ORM\Column(type: "integer")]
    private int $loyaltyPoints = 0;

    #[ORM\OneToOne(targetEntity: Location::class, cascade: ['persist', 'remove'], inversedBy: 'client')]
    #[ORM\JoinColumn(nullable: true, unique: false)]
    private ?Location $location = null;

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: "client")]
    private Collection $reviews;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: "client")]
    private Collection $vehicules;

    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: "client")]
    private Collection $critiques;

    #[ORM\OneToOne(targetEntity: Cart::class, mappedBy: 'client')]
    private ?Cart $cart = null;

    #[ORM\OneToMany(targetEntity: Complaint::class, mappedBy: "client")]
    private Collection $complaints;

    

    #[Vich\UploadableField(mapping: 'client_photoProfil', fileNameProperty: 'photoProfil')]
    private ?File $photoProfilFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photoProfil = null;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'clientSender')]
    private Collection $sentMessages;

    #[ORM\OneToMany(targetEntity: Conversation::class, mappedBy: 'client')]
    private Collection $conversations;

    public function __construct(
        string $name = '',
        string $email = '',
        ?string $adress = null,
        string $roles = "CLIENT",
        string $password = '',
        string $city = '',
        ?string $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        bool $verificationStatus = false,
        ?string $phone = null,
        ?string $photoProfil = null
    ) {
        parent::__construct($name, $email, $roles, $password, $city, $resetToken, $tokenExpiration, $phone, $photoProfil);

        $this->username = $name;
        $this->setRoles($roles);
        $this->dateInscription = new DateTimeImmutable();
        $this->verificationStatus = $verificationStatus;

        // Initialize all collections
        $this->reviews = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
        $this->critiques = new ArrayCollection();
        $this->complaints = new ArrayCollection();
        $this->sentMessages = new ArrayCollection();
        $this->conversations = new ArrayCollection();
    }

    public function setRoles(string $roles): User
    {
        return parent::setRoles("CLIENT");
    }

    // Getter and setter for the uploaded file
    public function getClientphotoProfilFile(): ?File
    {
        return $this->ClientphotoProfilFile;
    }

    public function setClientphotoProfilFile(?File $ClientphotoProfilFile): void
    {
        $this->ClientphotoProfilFile = $ClientphotoProfilFile;
        if ($ClientphotoProfilFile) {
            // Trigger file upload immediately
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    // Getter and setter for the filename (photo profile)


    






    // Other getters and setters
    public function isVerificationStatus(): bool
    {
        return $this->verificationStatus;
    }

    public function setVerificationStatus(bool $verificationStatus): void
    {
        $this->verificationStatus = $verificationStatus;
    }

    public function getDateInscription(): \DateTimeImmutable
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeImmutable $dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    public function getLoyaltyPoints(): int
    {
        return $this->loyaltyPoints;
    }

    public function setLoyaltyPoints(int $loyaltyPoints): void
    {
        $this->loyaltyPoints = $loyaltyPoints;
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function setReviews(Collection $reviews): void
    {
        $this->reviews = $reviews;
    }

    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function setVehicules(Collection $vehicules): void
    {
        $this->vehicules = $vehicules;
    }

    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function setCritiques(Collection $critiques): void
    {
        $this->critiques = $critiques;
    }

    public function getComplaints(): Collection
    {
        return $this->complaints;
    }

    public function setComplaints(Collection $complaints): void
    {
        $this->complaints = $complaints;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getPhotoProfilFile(): ?File
    {
        return $this->photoProfilFile;
    }

    public function setPhotoProfilFile(?File $photoProfilFile): void
    {
        $this->photoProfilFile = $photoProfilFile;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil(?string $photoProfil): void
    {
        $this->photoProfil = $photoProfil;
    }

    public function getSentMessages(): Collection
    {
        return $this->sentMessages;
    }

    public function addSentMessage(Message $message): self
    {
        if (!$this->sentMessages->contains($message)) {
            $this->sentMessages->add($message);
            $message->setClientSender($this);
        }
        return $this;
    }

    public function removeSentMessage(Message $message): self
    {
        if ($this->sentMessages->removeElement($message)) {
            if ($message->getClientSender() === $this) {
                $message->setClientSender(null);
            }
        }
        return $this;
    }

    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations->add($conversation);
            $conversation->setClient($this);
        }
        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            if ($conversation->getClient() === $this) {
                $conversation->setClient(null);
            }
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
}
