<?php

namespace App\Entity;

use App\Repository\RunesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RunesRepository::class)
 */
class Runes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $simple;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ra;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSimple(): ?string
    {
        return $this->simple;
    }

    public function setSimple(?string $simple): self
    {
        $this->simple = $simple;

        return $this;
    }

    public function getPa(): ?string
    {
        return $this->pa;
    }

    public function setPa(?string $pa): self
    {
        $this->pa = $pa;

        return $this;
    }

    public function getRa(): ?string
    {
        return $this->ra;
    }

    public function setRa(?string $ra): self
    {
        $this->ra = $ra;

        return $this;
    }
}
