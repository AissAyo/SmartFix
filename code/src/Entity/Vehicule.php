<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "vehicules")]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $model;
    

    #[ORM\Column(type: "string", length: 255)]
    private string $brand;


    #[ORM\ManyToOne(targetEntity: "App\Entity\Client", inversedBy: "vehicules")]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: CarAPI::class, inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CarAPI $carAPI = null;


    public function getCarAPI(): ?CarAPI
    {
        return $this->carAPI;
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

    // Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

}