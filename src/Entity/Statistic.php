<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatisticRepository")
 */
class Statistic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $match2;

    /**
     * @ORM\Column(type="integer")
     */
    private $match4;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\History", mappedBy="statistic")
     */
    private $histories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="statistics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="statistics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatch2(): ?int
    {
        return $this->match2;
    }

    public function setMatch2(int $match2): self
    {
        $this->match2 = $match2;

        return $this;
    }

    public function getMatch4(): ?int
    {
        return $this->match4;
    }

    public function setMatch4(int $match4): self
    {
        $this->match4 = $match4;

        return $this;
    }

    /**
     * @return Collection|History[]
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): self
    {
        if (!$this->histories->contains($history)) {
            $this->histories[] = $history;
            $history->setStatistic($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->contains($history)) {
            $this->histories->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getStatistic() === $this) {
                $history->setStatistic(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): self
    {
        $this->season = $season;

        return $this;
    }
}
