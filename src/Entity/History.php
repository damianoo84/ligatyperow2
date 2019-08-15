<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository")
 */
class History
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
    private $numOfPoints;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matchday", inversedBy="histories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matchday;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Statistic", inversedBy="histories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumOfPoints(): ?int
    {
        return $this->numOfPoints;
    }

    public function setNumOfPoints(int $numOfPoints): self
    {
        $this->numOfPoints = $numOfPoints;

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

    public function getStatistic(): ?Statistic
    {
        return $this->statistic;
    }

    public function setStatistic(?Statistic $statistic): self
    {
        $this->statistic = $statistic;

        return $this;
    }
}
