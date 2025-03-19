<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $shopName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $location;



    #[ORM\ManyToOne(targetEntity: Seller::class, inversedBy: 'shops')]
    #[ORM\JoinColumn(nullable: false)]
    private Seller $seller;


    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: 'shop')]
    private Collection $categories;

    public function __construct()
    {
        $this->seller = new Seller();
        $this->categories = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getShopName(): string
    {
        return $this->shopName;
    }

    public function setShopName(string $shopName): self
    {
        $this->shopName = $shopName;
        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function getSeller(): Seller
    {
        return $this->seller;
    }

    public function setSeller(Seller $seller): void
    {
        $this->seller = $seller;
    }


}