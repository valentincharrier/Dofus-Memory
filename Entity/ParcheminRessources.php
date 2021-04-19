<?php

namespace App\Entity;

use App\Repository\ParcheminRessourcesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcheminRessourcesRepository::class)
 */
class ParcheminRessources
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ParcheminElement::class, inversedBy="parcheminRessources", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $element;

    /**
     * @ORM\ManyToOne(targetEntity=ParcheminTaille::class, inversedBy="parcheminRessources", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Ressources::class, inversedBy="parcheminRessources", fetch="EAGER")
     */
    private $image;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(){
        return strval($this->getElement().' '.$this->getTaille());
    }

    public function getElement(): ?ParcheminElement
    {
        return $this->element;
    }

    public function setElement(?ParcheminElement $element): self
    {
        $this->element = $element;

        return $this;
    }

    public function getTaille(): ?ParcheminTaille
    {
        return $this->taille;
    }

    public function setTaille(?ParcheminTaille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getImage(): ?Ressources
    {
        return $this->image;
    }

    public function setImage(?Ressources $image): self
    {
        $this->image = $image;

        return $this;
    }

}
