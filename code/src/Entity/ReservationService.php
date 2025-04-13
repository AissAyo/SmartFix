<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class ReservationService
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Reservation::class, inversedBy: 'reservationServiceLinks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation = null;
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'reservationServiceLinks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service = null;


//    #[ORM\ForeingKey(targetEntity: Service::class)]
//    private int $ServiceId;
//    #[ORM\ForeingKey(targetEntity: Reservation::class)]
//    private int $ResevationId;


}
