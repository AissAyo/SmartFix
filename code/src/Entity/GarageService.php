<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity]
class GarageService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\ManyToOne(targetEntity: Garage::class, inversedBy: 'garageServices')]
    #[ORM\JoinColumn(nullable: false)]
    private Garage $garage;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'garageServices')]
    #[ORM\JoinColumn(nullable: false)]
    private Service $service;

    #[ORM\ManyToOne(targetEntity: CarAPI::class, inversedBy: 'garageServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CarAPI $carAPI = null;

 

    
    #[ORM\ManyToMany(targetEntity: Reservation::class, inversedBy: 'garageServices')]
    #[ORM\JoinTable(name: 'garage_service_reservation')]
    private Collection $reservations;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'GarageService')]
    private Collection $reviews;
 
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAverageRating(): float
    {
        $totalRating = 0;
        $count = count($this->reviews);

        // Si le service n'a pas d'avis, on retourne 0
        if ($count === 0) {
            return 0;
        }

        // Calculer la somme des notes des avis
        foreach ($this->reviews as $review) {
            $totalRating += $review->getRating(); // Appeler getRating() dans Review
        }

        // Retourner la moyenne des notes
        return $totalRating / $count;
    }


    public function getPrix(): float
    {
        return $this->price;
    }

    public function setPrix(float $price): self
    {
        $this->price = $price;
        return $this;
    }
    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }


    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;
        return $this;
    }
    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setGarageService($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getGarageService() === $this) {
                $review->setGarageService(null);
            }
        }

        return $this;
    }
}
