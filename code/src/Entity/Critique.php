<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "critiques")]
class Critique
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: "critiques")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: Reservation::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Reservation $reservation;

    #[ORM\ManyToOne(targetEntity: Garage::class, inversedBy: 'critiques')]
    #[ORM\JoinColumn(nullable: false)]
    private Garage $garage;

    #[ORM\ManyToOne(targetEntity: Mechanic::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Mechanic $mechanic;

    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: "critique")]
    private Collection $comments;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'critiques')]
    #[ORM\JoinColumn(nullable: false)]
    private Service $service;

    #[ORM\Column(type: "integer")]
    private int $rating;

    #[ORM\Column(type: "text")]
    private string $content;

    #[ORM\Column(type: "datetime")]
    private \DateTime $date;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    // Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function getReservation(): Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        $this->reservation = $reservation;
        return $this;
    }

    public function getGarage(): Garage
    {
        return $this->garage;
    }

    public function setGarage(Garage $garage): self
    {
        $this->garage = $garage;
        return $this;
    }

    public function getMechanic(): Mechanic
    {
        return $this->mechanic;
    }

    public function setMechanic(Mechanic $mechanic): self
    {
        $this->mechanic = $mechanic;
        return $this;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCritique($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCritique() === $this) {
                $comment->setCritique(null);
            }
        }

        return $this;
    }

    public function getService(): Service
    {
        return $this->service;
    }

    public function setService(Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }
}