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

    public function __construct(Client $client, Reservation $reservation, Service $service, Mechanic $mechanic)
{
    $this->client = $client;
    $this->reservation = $reservation;
    $this->service = $service;
    $this->mechanic = $mechanic;
    $this->comments = new ArrayCollection();
}
    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCritique($this);
        }
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    // Getters and setters for other attributes...
}