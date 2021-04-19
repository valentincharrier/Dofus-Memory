<?php

namespace App\Entity;

use App\Repository\DonjonsCardsDoubleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DonjonsCardsDoubleRepository::class)
 */
class DonjonsCardsDouble
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
    private $categorie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordre_publication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $paragraphes = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getOrdrePublication(): ?int
    {
        return $this->ordre_publication;
    }

    public function setOrdrePublication(?int $ordre_publication): self
    {
        $this->ordre_publication = $ordre_publication;

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

    public function getParagraphes(): ?array
    {
        return $this->paragraphes;
    }

    public function setParagraphes(?array $paragraphes): self
    {
        $this->paragraphes = $paragraphes;

        return $this;
    }
}
