<?php

namespace App\Entity;

use App\Repository\CategoriesEquipementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesEquipementsRepository::class)
 */
class CategoriesEquipements
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
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Equipements::class, mappedBy="categories_equipements")
     */
    private $equipements;

    public function __toString():string
    {
        return $this->categories;
    }

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(?string $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Equipements[]
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipements $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements[] = $equipement;
            $equipement->setCategoriesEquipements($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): self
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getCategoriesEquipements() === $this) {
                $equipement->setCategoriesEquipements(null);
            }
        }

        return $this;
    }
}
