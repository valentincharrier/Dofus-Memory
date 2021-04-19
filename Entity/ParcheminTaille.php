<?php

namespace App\Entity;

use App\Repository\ParcheminTailleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcheminTailleRepository::class)
 */
class ParcheminTaille
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $taille;

    /**
     * @ORM\OneToMany(targetEntity=ParcheminRessources::class, mappedBy="taille")
     */
    private $parcheminRessources;

    public function __toString(){
        return strval('< '.$this->getTaille());
    }

    public function __construct()
    {
        $this->parcheminRessources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection|ParcheminRessources[]
     */
    public function getParcheminRessources(): Collection
    {
        return $this->parcheminRessources;
    }

    public function addParcheminRessource(ParcheminRessources $parcheminRessource): self
    {
        if (!$this->parcheminRessources->contains($parcheminRessource)) {
            $this->parcheminRessources[] = $parcheminRessource;
            $parcheminRessource->setTaille($this);
        }

        return $this;
    }

    public function removeParcheminRessource(ParcheminRessources $parcheminRessource): self
    {
        if ($this->parcheminRessources->removeElement($parcheminRessource)) {
            // set the owning side to null (unless already changed)
            if ($parcheminRessource->getTaille() === $this) {
                $parcheminRessource->setTaille(null);
            }
        }

        return $this;
    }
}
