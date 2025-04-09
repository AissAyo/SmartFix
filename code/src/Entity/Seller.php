<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;  // Correct import
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity]
#[ORM\Table(name: "sellers")]
#[Vich\Uploadable]  // Mark entity as uploadable
class Seller extends Garagiste
{
    // Correct the usage of Vich\UploadableField
    #[Vich\UploadableField(mapping: 'seller_photoProfil', fileNameProperty: 'sellerPhotoProfil')]
    private ?File $SellerphotoProfilFile = null;


    #[Vich\UploadableField(mapping: 'seller_logo', fileNameProperty: 'logo')]
    private ?File $logoFile = null;




    #[ORM\Column(type: "string", length: 255)]
    protected string $contactInfo;

    #[ORM\OneToMany(targetEntity: Shop::class, mappedBy: 'seller')]
    private Collection $shops;

    public function __construct(
        string $name='',
        string $email='',
        string $contactInfo='',
        string $roles = "Seller",
        ?string $password = null,
        ?string $resetToken = null,
        ?string  $logo = null,
        ?DateTimeInterface $tokenExpiration = null,
        ?string $phoneNumber = null,
        ?string $workingHours = null
    ) {
        parent::__construct($name, $email, $roles, $password, $resetToken, $tokenExpiration, $phoneNumber, $logo, $workingHours);
        $this->contactInfo = $contactInfo;
    }

    public function getContactInfo(): string
    {
        return $this->contactInfo;
    }

    public function setContactInfo(string $contactInfo): void
    {
        $this->contactInfo = $contactInfo;
    }

    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function setShops(Collection $shops): void
    {
        $this->shops = $shops;
    }

    // Getter and Setter for logoFile
    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function setLogoFile(?File $logoFile): void
    {
        $this->logoFile = $logoFile;
    }

    // Getter and Setter for logofilFile
    public function getLogofilFile(): ?File
    {
        return $this->logofilFile;
    }

    public function setLogofilFile(?File $logofilFile): void
    {
        $this->logofilFile = $logofilFile;
    }
}
