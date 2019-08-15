<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Type", mappedBy="user")
     */
    private $types;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Statistic", mappedBy="user")
     */
    private $statistics;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->statistics = new ArrayCollection();
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
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Type[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->setUser($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->types->contains($type)) {
            $this->types->removeElement($type);
            // set the owning side to null (unless already changed)
            if ($type->getUser() === $this) {
                $type->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Statistic[]
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function addStatistic(Statistic $statistic): self
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics[] = $statistic;
            $statistic->setUser($this);
        }

        return $this;
    }

    public function removeStatistic(Statistic $statistic): self
    {
        if ($this->statistics->contains($statistic)) {
            $this->statistics->removeElement($statistic);
            // set the owning side to null (unless already changed)
            if ($statistic->getUser() === $this) {
                $statistic->setUser(null);
            }
        }

        return $this;
    }
}
