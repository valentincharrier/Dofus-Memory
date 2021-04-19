<?php

namespace App\Entity;

use App\Repository\FamilierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FamilierRepository::class)
 */
class Familier
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
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intervalle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $obtention;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $nourriture = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $effetsGeneraux;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pointsDeVie;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(?int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getIntervalle(): ?string
    {
        return $this->intervalle;
    }

    public function setIntervalle(?string $intervalle): self
    {
        $this->intervalle = $intervalle;

        return $this;
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

    public function getObtention(): ?string
    {
        return $this->obtention;
    }

    public function setObtention(?string $obtention): self
    {
        $this->obtention = $obtention;

        return $this;
    }

    public function getNourriture(): ?array
    {
        return $this->nourriture;
    }

    public function setNourriture(?array $nourriture): self
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    public function getEffetsGeneraux(): ?string
    {
        return $this->effetsGeneraux;
    }

    public function setEffetsGeneraux(?string $effetsGeneraux): self
    {
        $this->effetsGeneraux = $effetsGeneraux;

        return $this;
    }

    public function getPointsDeVie(): ?string
    {
        return $this->pointsDeVie;
    }

    public function setPointsDeVie(?string $pointsDeVie): self
    {
        $this->pointsDeVie = $pointsDeVie;

        return $this;
    }

}
