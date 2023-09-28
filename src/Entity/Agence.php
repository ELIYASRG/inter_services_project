<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
class Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    #[Assert\NotBlank(
        message: "La ville est obligatoire."
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: "La ville doit contenir au maximum {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[Assert\NotBlank(
        message: "La nom de l'agence est obligatoire."
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: "La nom de l'agence doit contenir au maximum {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;
    
    #[ORM\Column(length: 15, nullable: true)]
    private ?string $tel = null;
    
    #[Assert\NotBlank(
        message: "L'adresse de l'agence est obligatoire."
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: "L'adresse de l'agence doit contenir au maximum {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 255)]
    private ?string $adresse = null;
    
    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $tarif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
