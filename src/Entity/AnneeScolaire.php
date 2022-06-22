<?php

namespace App\Entity;

use App\Repository\AnneeScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeScolaireRepository::class)]
class AnneeScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $libelleAnnee;

    #[ORM\OneToMany(mappedBy: 'annescolaire', targetEntity: Inscrire::class)]
    private $inscrires;

    public function __construct()
    {
        $this->inscrires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleAnnee(): ?string
    {
        return $this->libelleAnnee;
    }

    public function setLibelleAnnee(string $libelleAnnee): self
    {
        $this->libelleAnnee = $libelleAnnee;

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
            $inscrire->setAnnescolaire($this);
        }

        return $this;
    }

    public function removeInscrire(Inscrire $inscrire): self
    {
        if ($this->inscrires->removeElement($inscrire)) {
            // set the owning side to null (unless already changed)
            if ($inscrire->getAnnescolaire() === $this) {
                $inscrire->setAnnescolaire(null);
            }
        }

        return $this;
    }
}
