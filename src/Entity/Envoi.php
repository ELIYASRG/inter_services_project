<?php

namespace App\Entity;

use App\Repository\EnvoiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: EnvoiRepository::class)]
class Envoi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $depart = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_e = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_e = null;

    #[ORM\Column(length: 15)]
    private ?string $tel_e = null;

    #[ORM\Column(length: 16)]
    private ?string $identite = null;

    #[ORM\Column(length: 20)]
    private ?string $id_e = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_d = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_d = null;

    #[ORM\Column(length: 15)]
    private ?string $tel_d = null;

    #[ORM\Column(length: 20)]
    private ?string $id_d = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $n_colis = null;

    #[ORM\Column(options: ['default' => false] )]
    private ?bool $paye = null;

    #[ORM\Column(length: 6)]
    private ?string $mode_paiement = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $poids_t = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'envois')]
    private ?User $user = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;
    
    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getNomE(): ?string
    {
        return $this->nom_e;
    }

    public function setNomE(string $nom_e): self
    {
        $this->nom_e = $nom_e;

        return $this;
    }

    public function getPrenomE(): ?string
    {
        return $this->prenom_e;
    }

    public function setPrenomE(string $prenom_e): self
    {
        $this->prenom_e = $prenom_e;

        return $this;
    }

    public function getTelE(): ?string
    {
        return $this->tel_e;
    }

    public function setTelE(string $tel_e): self
    {
        $this->tel_e = $tel_e;

        return $this;
    }

    public function getIdentite(): ?string
    {
        return $this->identite;
    }
    
    public function setIdentite(string $identite): self
    {
        $this->identite = $identite;

        return $this;
    }

    public function getIdE(): ?string
    {
        return $this->id_e;
    }

    public function setIdE(string $id_e): self
    {
        $this->id_e = $id_e;

        return $this;
    }

    public function getImageId(): ?string
    {
        return $this->image_id;
    }

    public function setImageId(?string $image_id): self
    {
        $this->image_id = $image_id;

        return $this;
    }

    public function getNomD(): ?string
    {
        return $this->nom_d;
    }

    public function setNomD(string $nom_d): self
    {
        $this->nom_d = $nom_d;

        return $this;
    }

    public function getPrenomD(): ?string
    {
        return $this->prenom_d;
    }

    public function setPrenomD(string $prenom_d): self
    {
        $this->prenom_d = $prenom_d;

        return $this;
    }

    public function getTelD(): ?string
    {
        return $this->tel_d;
    }

    public function setTelD(string $tel_d): self
    {
        $this->tel_d = $tel_d;

        return $this;
    }

    public function getIdD(): ?string
    {
        return $this->id_d;
    }

    public function setIdD(string $id_d): self
    {
        $this->id_d = $id_d;

        return $this;
    }

    public function getNColis(): ?int
    {
        return $this->n_colis;
    }

    public function setNColis(int $n_colis): self
    {
        $this->n_colis = $n_colis;

        return $this;
    }

    public function isPaye(): ?bool
    {
        return $this->paye;
    }

    public function setPaye(bool $paye): self
    {
        $this->paye = $paye;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->mode_paiement;
    }

    public function setModePaiement(string $mode_paiement): self
    {
        $this->mode_paiement = $mode_paiement;

        return $this;
    }

    public function getPoidsT(): ?int
    {
        return $this->poids_t;
    }

    public function setPoidsT(int $poids_t): self
    {
        $this->poids_t = $poids_t;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
