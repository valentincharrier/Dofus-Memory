<?php

namespace App\Entity;

use App\Repository\ArchimonstresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArchimonstresRepository::class)
 */
class Archimonstres
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
    private $etape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_commun;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_monster;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zone;

    /**
     * @ORM\OneToMany(targetEntity=UserMonster::class, mappedBy="id_monster", fetch="EAGER")
     */
    private $userMonsters;

    public function __construct()
    {
        $this->nbr_captures = new ArrayCollection();
        $this->userMonsters = new ArrayCollection();
    }

    public function __toString(){
        return $this->getNom();
    }

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

    public function getEtape(): ?int
    {
        return $this->etape;
    }

    public function setEtape(?int $etape): self
    {
        $this->etape = $etape;

        return $this;
    }

    public function getNomCommun(): ?string
    {
        return $this->nom_commun;
    }

    public function setNomCommun(?string $nom_commun): self
    {
        $this->nom_commun = $nom_commun;

        return $this;
    }

    public function getImageMonster(): ?string
    {
        return $this->image_monster;
    }

    public function setImageMonster(?string $image_monster): self
    {
        $this->image_monster = $image_monster;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(?string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * @return Collection|UserMonster[]
     */
    public function getUserMonsters(): Collection
    {
        return $this->userMonsters;
    }

    public function addUserMonster(UserMonster $userMonster): self
    {
        if (!$this->userMonsters->contains($userMonster)) {
            $this->userMonsters[] = $userMonster;
            $userMonster->setIdMonster($this);
        }

        return $this;
    }

    public function removeUserMonster(UserMonster $userMonster): self
    {
        if ($this->userMonsters->removeElement($userMonster)) {
            // set the owning side to null (unless already changed)
            if ($userMonster->getIdMonster() === $this) {
                $userMonster->setIdMonster(null);
            }
        }

        return $this;
    }


}
