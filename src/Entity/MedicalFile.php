<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MedicalFileRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MedicalFileRepository::class)]
class MedicalFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergies = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["getUsers"])]
    private ?string $documents = null;

    #[ORM\ManyToOne]
    #[Groups(["getUsers"])]
    private ?Reservation $reservations = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(?string $allergies): static
    {
        $this->allergies = $allergies;

        return $this;
    }

    public function getDocuments(): ?string
    {
        return $this->documents;
    }

    public function setDocuments(?string $documents): static
    {
        $this->documents = $documents;

        return $this;
    }

    public function getReservations(): ?Reservation
    {
        return $this->reservations;
    }

    public function setReservations(?Reservation $reservations): static
    {
        $this->reservations = $reservations;

        return $this;
    }
}
