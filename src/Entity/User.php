<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getUsers"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le genre de l'utilisateur est obligatoire")]
    #[Assert\Length(min : 1, max:20, minMessage: "Le genre doit faire au moins 1 caractère", maxMessage:"le genre doit faire au plus 20 caractères.")]
    private ?string $gender = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le nom de famille de l'utilisateur est obligatoire")]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le prénom de l'utilisateur est obligatoire")]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getUsers"])]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getUsers"])]
    private ?string $emailAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    #[Groups(["getUsers"])]
    private ?int $socialSecurity = null;

    #[ORM\Column]
    #[Groups(["getUsers"])]
    private ?bool $isAdmin = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(["getUsers"])]
    private ?MedicalFile $medicalFile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): static
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getSocialSecurity(): ?int
    {
        return $this->socialSecurity;
    }

    public function setSocialSecurity(int $socialSecurity): static
    {
        $this->socialSecurity = $socialSecurity;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getMedicalFile(): ?MedicalFile
    {
        return $this->medicalFile;
    }

    public function setMedicalFile(?MedicalFile $medicalFile): static
    {
        $this->medicalFile = $medicalFile;

        return $this;
    }
}
