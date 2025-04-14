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
    #[Vich\UploadableField(mapping: 'user_upload', fileNameProperty: 'photoProfil')]
    private ?File $MechanicphotoProfilFile = null;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $certifications ;
    #[Vich\UploadableField(mapping: 'mechanic_logo', fileNameProperty: 'logo')]
     private ?File $logoFile = null; // Initialize to null    #[ORM\OneToMany(targetEntity: Garage::class, mappedBy: 'mechanic')]
    #[ORM\OneToMany(targetEntity: Garage::class, mappedBy: 'mechanic')]
    private Collection $garages;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;



    public function __construct(
        string $name = '',
        string $email = '',
        ?string $city = '',
        ?string $address = '',
        string $roles = 'MECHANIC',
        ?string $password = 'null123',
        ?string $resetToken = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string $phone = null,
        ?string $photoProfil = null,
        ?string $specialization = null,
        ?int $experienceYears = null,
        ?string $certifications = ''
    ) {
        parent::__construct($name, $email, $city, $address, $roles, $password, $resetToken, $tokenExpiration, $phone, $photoProfil);
        $this->garages = new ArrayCollection();
        $this->specialization = $specialization;
        $this->experienceYears = $experienceYears;
        $this->certifications = $certifications ;  // Initialize as empty array if null
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

    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function setLogoFile(?File $logoFile = null): void
    {
        $this->logoFile = $logoFile;
        if ($logoFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getMechanicphotoProfilFile(): ?File
    {
        return $this->MechanicphotoProfilFile;
    }

    public function setMechanicphotoProfilFile(?File $MechanicphotoProfilFile): void
    {
        $this->MechanicphotoProfilFile = $MechanicphotoProfilFile;
    }

    public function getMechanicServices(): Collection
    {
        return $this->MechanicServices;
    }

    public function setMechanicServices(Collection $MechanicServices): void
    {
        $this->MechanicServices = $MechanicServices;
    }

}
