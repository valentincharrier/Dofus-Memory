<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="Email déja utilisée !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=UserMonster::class, mappedBy="id_user", fetch="EAGER", orphanRemoval=true)
     */
    private $userMonsters;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serveur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEmailValidate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreationCompte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastIpUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $limitTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $monstresDejaCapture;

    public function __construct()
    {
        $this->userMonsters = new ArrayCollection();
    }

    public function __toString(){
        return $this->getEmail();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $userMonster->setIdUser($this);
        }

        return $this;
    }

    public function removeUserMonster(UserMonster $userMonster): self
    {
        if ($this->userMonsters->removeElement($userMonster)) {
            // set the owning side to null (unless already changed)
            if ($userMonster->getIdUser() === $this) {
                $userMonster->setIdUser(null);
            }
        }

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getServeur(): ?string
    {
        return $this->serveur;
    }

    public function setServeur(string $serveur): self
    {
        $this->serveur = $serveur;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getIsEmailValidate(): ?bool
    {
        return $this->isEmailValidate;
    }

    public function setIsEmailValidate(bool $isEmailValidate): self
    {
        $this->isEmailValidate = $isEmailValidate;

        return $this;
    }

    public function getDateCreationCompte(): ?\DateTimeInterface
    {
        return $this->dateCreationCompte;
    }

    public function setDateCreationCompte(\DateTimeInterface $dateCreationCompte): self
    {
        $this->dateCreationCompte = $dateCreationCompte;

        return $this;
    }

    public function getLastIpUser(): ?string
    {
        return $this->lastIpUser;
    }

    public function setLastIpUser(?string $lastIpUser): self
    {
        $this->lastIpUser = $lastIpUser;

        return $this;
    }

    public function getLimitTime(): ?int
    {
        return $this->limitTime;
    }

    public function setLimitTime(int $limitTime): self
    {
        $this->limitTime = $limitTime;

        return $this;
    }

    public function getMonstresDejaCapture(): ?int
    {
        return $this->monstresDejaCapture;
    }

    public function setMonstresDejaCapture(int $monstresDejaCapture): self
    {
        $this->monstresDejaCapture = $monstresDejaCapture;

        return $this;
    }

}
