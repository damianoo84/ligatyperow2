<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeagueRepository")
 */
class League
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Meet", mappedBy="league")
     */
    private $meets;

    public function __construct()
    {
        $this->meets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Meet[]
     */
    public function getMeets(): Collection
    {
        return $this->meets;
    }

    public function addMeet(Meet $meet): self
    {
        if (!$this->meets->contains($meet)) {
            $this->meets[] = $meet;
            $meet->setLeague($this);
        }

        return $this;
    }

    public function removeMeet(Meet $meet): self
    {
        if ($this->meets->contains($meet)) {
            $this->meets->removeElement($meet);
            // set the owning side to null (unless already changed)
            if ($meet->getLeague() === $this) {
                $meet->setLeague(null);
            }
        }

        return $this;
    }
}
