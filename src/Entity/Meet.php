<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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

}
