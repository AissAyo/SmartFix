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
    private int $id; // Ensure this column is named 'id'

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $location;

    #[ORM\ManyToOne(targetEntity: Seller::class, inversedBy: 'shops')]
    #[ORM\JoinColumn(nullable: false)]
    private Seller $seller;


    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: 'shop')]
    private Collection $categories;

    public function __construct()
    {
        $this->sellers = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
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

    public function getSellers(): Collection
    {
        return $this->sellers;
    }

    public function addSeller(Seller $seller): self
    {
        if (!$this->sellers->contains($seller)) {
            $this->sellers[] = $seller;
            $seller->setShop($this);
        }

        return $this;
    }

    public function removeSeller(Seller $seller): self
    {
        if ($this->sellers->removeElement($seller)) {
            // set the owning side to null (unless already changed)
            if ($seller->getShop() === $this) {
                $seller->setShop(null);
            }
        }

        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setShop($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getShop() === $this) {
                $category->setShop(null);
            }
        }

        return $this;
    }
}