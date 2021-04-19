<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RessourcesRepository::class)
 */
class Ressources
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=ParcheminRessources::class, mappedBy="image", fetch="EAGER")
     */
    private $parcheminRessources;

    public function __toString(){
        return $this->getNom();
    }

    public function __construct()
    {
        $this->parcheminRessources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
            $parcheminRessource->setImage($this);
        }

        return $this;
    }

    public function removeParcheminRessource(ParcheminRessources $parcheminRessource): self
    {
        if ($this->parcheminRessources->removeElement($parcheminRessource)) {
            // set the owning side to null (unless already changed)
            if ($parcheminRessource->getImage() === $this) {
                $parcheminRessource->setImage(null);
            }
        }

        return $this;
    }
}
