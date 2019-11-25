<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeetRepository")
 */
class Meet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hostTeam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $guestTeam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matchday", inversedBy="meets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matchday;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League", inversedBy="meets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $league;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Type", mappedBy="meet")
     */
    private $types;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hostGoals;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $guestGoals;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $term;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHostTeam(): ?Team
    {
        return $this->hostTeam;
    }

    public function setHostTeam(?Team $hostTeam): self
    {
        $this->hostTeam = $hostTeam;

        return $this;
    }

    public function getGuestTeam(): ?Team
    {
        return $this->guestTeam;
    }

    public function setGuestTeam(?Team $guestTeam): self
    {
        $this->guestTeam = $guestTeam;

        return $this;
    }

    public function getMatchday(): ?Matchday
    {
        return $this->matchday;
    }

    public function setMatchday(?Matchday $matchday): self
    {
        $this->matchday = $matchday;

        return $this;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

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
            $type->setMeet($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->types->contains($type)) {
            $this->types->removeElement($type);
            // set the owning side to null (unless already changed)
            if ($type->getMeet() === $this) {
                $type->setMeet(null);
            }
        }

        return $this;
    }

    public function getHostGoals(): ?int
    {
        return $this->hostGoals;
    }

    public function setHostGoals(?int $hostGoals): self
    {
        $this->hostGoals = $hostGoals;

        return $this;
    }

    public function getGuestGoals(): ?int
    {
        return $this->guestGoals;
    }

    public function setGuestGoals(?int $guestGoals): self
    {
        $this->guestGoals = $guestGoals;

        return $this;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(?string $term): self
    {
        $this->term = $term;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

}
