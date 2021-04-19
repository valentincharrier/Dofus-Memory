<?php

namespace App\Entity;

use App\Repository\EquipementsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipementsRepository::class)
 */
class Equipements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $recette;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $caracteristiques;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conditions;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emplacement_img;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriesEquipements::class, inversedBy="equipements", fetch="EAGER")
     */
    private $categories_equipements;

    public function __toString():string
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

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

    public function getRecette(): ?string
    {
        return $this->recette;
    }

    public function setRecette(?string $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getCaracteristiques(): ?string
    {
        return $this->caracteristiques;
    }

    public function setCaracteristiques(?string $caracteristiques): self
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(?string $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEmplacementImg(): ?string
    {
        return $this->emplacement_img;
    }

    public function setEmplacementImg(?string $emplacement_img): self
    {
        $this->emplacement_img = $emplacement_img;

        return $this;
    }

    public function getCategoriesEquipements(): ?CategoriesEquipements
    {
        return $this->categories_equipements;
    }

    public function setCategoriesEquipements(?CategoriesEquipements $categories_equipements): self
    {
        $this->categories_equipements = $categories_equipements;

        return $this;
    }
}
