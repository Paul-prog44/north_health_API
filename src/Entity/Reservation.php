<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?hospitalization $hospitalization = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?doctor $doctor = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHospitalization(): ?hospitalization
    {
        return $this->hospitalization;
    }

    public function setHospitalization(?hospitalization $hospitalization): static
    {
        $this->hospitalization = $hospitalization;

        return $this;
    }

    public function getDoctor(): ?doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?doctor $doctor): static
    {
        $this->doctor = $doctor;

        return $this;
    }

}
