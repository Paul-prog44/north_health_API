<?php

namespace App\Entity;

use App\Repository\HospitalizationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HospitalizationRepository::class)]
class Hospitalization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?bool $isVegeterian = null;

    #[ORM\Column]
    private ?bool $isSingleRoom = null;

    #[ORM\Column]
    private ?bool $isTelevision = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function isIsVegeterian(): ?bool
    {
        return $this->isVegeterian;
    }

    public function setIsVegeterian(bool $isVegeterian): static
    {
        $this->isVegeterian = $isVegeterian;

        return $this;
    }

    public function isIsSingleRoom(): ?bool
    {
        return $this->isSingleRoom;
    }

    public function setIsSingleRoom(bool $isSingleRoom): static
    {
        $this->isSingleRoom = $isSingleRoom;

        return $this;
    }

    public function isIsTelevision(): ?bool
    {
        return $this->isTelevision;
    }

    public function setIsTelevision(bool $isTelevision): static
    {
        $this->isTelevision = $isTelevision;

        return $this;
    }
}
