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

    #[ORM\ManyToOne(targetEntity: "App\Entity\Client")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Reservation")]
    #[ORM\JoinColumn(nullable: false)]
    private Reservation $reservation;

    #[ORM\ManyToOne(targetEntity: Garage::class, inversedBy: 'Critique')]
    #[ORM\JoinColumn(nullable: false)]
    private Service $service;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Garagiste")]
    #[ORM\JoinColumn(nullable: false)]
    private Garagiste $garagiste;

    #[ORM\OneToMany(targetEntity: "App\Entity\Comment", mappedBy: "critique")]
    private Collection $comments;

    public function __construct(Client $client, Reservation $reservation, Service $service, Garagiste $garagiste)
    {
        $this->client = $client;
        $this->reservation = $reservation;
        $this->service = $service;
        $this->garagiste = $garagiste;
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