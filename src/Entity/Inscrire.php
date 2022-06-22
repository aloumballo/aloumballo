<?php

namespace App\Entity;

use App\Repository\InscrireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscrireRepository::class)]
class Inscrire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $etatInscription;

    #[ORM\ManyToOne(targetEntity: AnneeScolaire::class, inversedBy: 'inscrires')]
    private $annescolaire;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'inscrires')]
    private $etudiant;

    #[ORM\ManyToOne(targetEntity: AC::class, inversedBy: 'inscrires')]
    private $ac;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'inscrires')]
    private $classe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatInscription(): ?string
    {
        return $this->etatInscription;
    }

    public function setEtatInscription(string $etatInscription): self
    {
        $this->etatInscription = $etatInscription;

        return $this;
    }

    public function getAnnescolaire(): ?AnneeScolaire
    {
        return $this->annescolaire;
    }

    public function setAnnescolaire(?AnneeScolaire $annescolaire): self
    {
        $this->annescolaire = $annescolaire;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getAc(): ?AC
    {
        return $this->ac;
    }

    public function setAc(?AC $ac): self
    {
        $this->ac = $ac;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}
