<?php
namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity]
#[Vich\Uploadable]
class Mechanic extends Garagiste
{
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(max: 100)]
    private ?string $specialization = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Range(min: 0, max: 50)]
    private ?int $experienceYears = null;



    #[Vich\UploadableField(mapping: 'mechanic_photoProfil', fileNameProperty: 'photoProfil')]
    private ?File $photoProfilFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photoProfil = null;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $certifications ;

    #[ORM\OneToMany(targetEntity: Garage::class, mappedBy: 'mechanic')]
    private Collection $garages;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'mechanicSender')]
    private Collection $sentMessages;

    #[ORM\OneToMany(targetEntity: Conversation::class, mappedBy: 'mechanic')]
    private Collection $conversations;

    public function __construct(
        string $name = '',
        string $email = '',
        ?string $address = '',
        string $roles = 'MECHANIC',
        ?string $password = 'null123',
        ?string $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string $phone = null,
        ?string $photoProfil = "avatar5.png",
        ?string $specialization = null,
        ?int $experienceYears = null,
        ?string $certifications = '',
        ?string $city = null,
    ) {
        parent::__construct(
            $name, 
            $email, 
            $address, 
            $roles, 
            $password, 
            $resetToken, 
            $tokenExpiration, 
            $phone,
            $city
        );
        $this->garages = new ArrayCollection();
        $this->specialization = $specialization;
        $this->experienceYears = $experienceYears;
        $this->certifications = $certifications;
        $this->photoProfil = $photoProfil ?? "avatar5.png";
        $this->sentMessages = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->city = $city;
    }

    public function getGarages(): Collection
    {
        return $this->garages;
    }

    public function setGarages(Collection $garages): void
    {
        $this->garages = $garages;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(?string $specialization): void
    {
        $this->specialization = $specialization;
    }

    public function getExperienceYears(): ?int
    {
        return $this->experienceYears;
    }

    public function setExperienceYears(?int $experienceYears): void
    {
        $this->experienceYears = $experienceYears;
    }

    public function getCertifications(): ?string
    {
        return $this->certifications ; // Return empty string if null
    }



    public function setCertifications(string $certifications): void
    {
        $this->certifications = $certifications;
    }




    public function getMechanicServices(): Collection
    {
        return $this->MechanicServices;
    }

    public function setMechanicServices(Collection $MechanicServices): void
    {
        $this->MechanicServices = $MechanicServices;
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
            $message->setMechanicSender($this);
        }
        return $this;
    }

    public function removeSentMessage(Message $message): self
    {
        if ($this->sentMessages->removeElement($message)) {
            if ($message->getMechanicSender() === $this) {
                $message->setMechanicSender(null);
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
            $conversation->setMechanic($this);
        }
        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            if ($conversation->getMechanic() === $this) {
                $conversation->setMechanic(null);
            }
        }
        return $this;
    }
}
