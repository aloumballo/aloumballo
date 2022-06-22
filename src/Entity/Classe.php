<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $libelle;

    #[ORM\Column(type: 'string', length: 20)]
    private $filiere;

    #[ORM\Column(type: 'string', length: 20)]
    private $niveau;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Inscrire::class)]
    private $inscrires;

    #[ORM\ManyToOne(targetEntity: RP::class, inversedBy: 'classes')]
    private $rP;

    #[ORM\ManyToMany(targetEntity: Professeur::class, mappedBy: 'classes')]
    private $professeurs;

    public function __construct()
    {
        $this->inscrires = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Inscrire>
     */
    public function getInscrires(): Collection
    {
        return $this->inscrires;
    }

    public function addInscrire(Inscrire $inscrire): self
    {
        if (!$this->inscrires->contains($inscrire)) {
            $this->inscrires[] = $inscrire;
            $inscrire->setClasse($this);
        }

        return $this;
    }

    public function removeInscrire(Inscrire $inscrire): self
    {
        if ($this->inscrires->removeElement($inscrire)) {
            // set the owning side to null (unless already changed)
            if ($inscrire->getClasse() === $this) {
                $inscrire->setClasse(null);
            }
        }

        return $this;
    }

    public function getRP(): ?RP
    {
        return $this->rP;
    }

    public function setRP(?RP $rP): self
    {
        $this->rP = $rP;

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->addClass($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeClass($this);
        }

        return $this;
    }
}
