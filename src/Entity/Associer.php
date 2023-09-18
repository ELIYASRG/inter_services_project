<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AssocierRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AssocierRepository::class)]
class Associer extends User
{

    #[Assert\NotBlank(
        message: "Le nom de l'agence est obligatoire."
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom de l'agence doit contenir au maximum {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 255)]
    private ?string $agence = null;

    #[ORM\Column(nullable: true)]
    private ?int $tarif = null;

    public function getAgence(): ?string
    {
        return $this->agence;
    }

    public function setAgence(string $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(?int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }
}
