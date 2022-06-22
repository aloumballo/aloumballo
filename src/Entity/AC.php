<?php

namespace App\Entity;

use App\Repository\ACRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ACRepository::class)]
class AC extends User
{
   
    #[ORM\OneToMany(mappedBy: 'ac', targetEntity: Inscrire::class)]
    private $inscrires;

    public function __construct()
    {
        $this->inscrires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $inscrire->setAc($this);
        }

        return $this;
    }

    public function removeInscrire(Inscrire $inscrire): self
    {
        if ($this->inscrires->removeElement($inscrire)) {
            // set the owning side to null (unless already changed)
            if ($inscrire->getAc() === $this) {
                $inscrire->setAc(null);
            }
        }

        return $this;
    }
}