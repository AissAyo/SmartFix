<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Reservation;

#[ORM\Entity(repositoryClass: "App\Repository\ReviewRepository")]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Reservation::class, inversedBy: "reviews")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation;

    #[ORM\Column(type: "integer")]
    private ?int $rating;

    #[ORM\Column(type: "text")]
    private ?string $comment;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}