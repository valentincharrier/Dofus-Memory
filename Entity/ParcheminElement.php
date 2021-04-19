<?php

namespace App\Entity;

use App\Repository\ParcheminElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcheminElementRepository::class)
 */
class ParcheminElement
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
    private $element;

    /**
     * @ORM\OneToMany(targetEntity=ParcheminRessources::class, mappedBy="element")
     */
    private $parcheminRessources;

    public function __toString(){
        return $this->getElement();
    }

    public function __construct()
    {
        $this->parcheminRessources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getElement(): ?string
    {
        return $this->element;
    }

    public function setElement(string $element): self
    {
        $this->element = $element;

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
            $parcheminRessource->setElement($this);
        }

        return $this;
    }

    public function removeParcheminRessource(ParcheminRessources $parcheminRessource): self
    {
        if ($this->parcheminRessources->removeElement($parcheminRessource)) {
            // set the owning side to null (unless already changed)
            if ($parcheminRessource->getElement() === $this) {
                $parcheminRessource->setElement(null);
            }
        }

        return $this;
    }
}
