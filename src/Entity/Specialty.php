<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SpecialtyRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SpecialtyRepository::class)]
class Specialty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getCenter"])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Doctor::class, inversedBy: 'specialties')]
    private Collection $doctors;

    #[ORM\ManyToMany(targetEntity: Center::class, mappedBy: 'specialties')]
    private Collection $centers;

    public function __construct()
    {
        $this->doctors = new ArrayCollection();
        $this->centers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Doctor>
     */
    public function getDoctors(): Collection
    {
        return $this->doctors;
    }

    public function addDoctor(Doctor $doctor): static
    {
        if (!$this->doctors->contains($doctor)) {
            $this->doctors->add($doctor);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): static
    {
        $this->doctors->removeElement($doctor);

        return $this;
    }

    /**
     * @return Collection<int, Center>
     */
    public function getCenters(): Collection
    {
        return $this->centers;
    }

    public function addCenter(Center $center): static
    {
        if (!$this->centers->contains($center)) {
            $this->centers->add($center);
            $center->addSpecialty($this);
        }

        return $this;
    }

    public function removeCenter(Center $center): static
    {
        if ($this->centers->removeElement($center)) {
            $center->removeSpecialty($this);
        }

        return $this;
    }
}
