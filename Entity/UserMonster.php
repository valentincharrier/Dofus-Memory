<?php

namespace App\Entity;

use App\Repository\UserMonsterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserMonsterRepository::class)
 */
class UserMonster
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userMonsters")
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=Archimonstres::class, inversedBy="userMonsters")
     */
    private $id_monster;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_captures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdMonster(): ?Archimonstres
    {
        return $this->id_monster;
    }

    public function setIdMonster(?Archimonstres $id_monster): self
    {
        $this->id_monster = $id_monster;

        return $this;
    }

    public function getNbrCaptures(): ?int
    {
        return $this->nbr_captures;
    }

    public function setNbrCaptures(?int $nbr_captures): self
    {
        $this->nbr_captures = $nbr_captures;

        return $this;
    }
}
