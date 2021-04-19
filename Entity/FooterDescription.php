<?php

namespace App\Entity;

use App\Repository\FooterDescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FooterDescriptionRepository::class)
 */
class FooterDescription
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
    private $pagename;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $paragraphe = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPagename(): ?string
    {
        return $this->pagename;
    }

    public function setPagename(?string $pagename): self
    {
        $this->pagename = $pagename;

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

    public function getParagraphe(): ?array
    {
        return $this->paragraphe;
    }

    public function setParagraphe(?array $paragraphe): self
    {
        $this->paragraphe = $paragraphe;

        return $this;
    }
}
