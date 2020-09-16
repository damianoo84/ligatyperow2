<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfPoints;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="types")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meet", inversedBy="types")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meet;

    /**
     * @ORM\Column(type="integer")
     */
    private $hostType;

    /**
     * @ORM\Column(type="integer")
     */
    private $guestType;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfPoints(): ?int
    {
        return $this->numberOfPoints;
    }

    public function setNumberOfPoints(?int $numberOfPoints): self
    {
        $this->numberOfPoints = $numberOfPoints;

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

    public function getMeet(): ?Meet
    {
        return $this->meet;
    }

    public function setMeet(?Meet $meet): self
    {
        $this->meet = $meet;

        return $this;
    }

    public function getHostType(): ?int
    {
        return $this->hostType;
    }

    public function setHostType(int $hostType): self
    {
        $this->hostType = $hostType;

        return $this;
    }

    public function getGuestType(): ?int
    {
        return $this->guestType;
    }

    public function setGuestType(int $guestType): self
    {
        $this->guestType = $guestType;

        return $this;
    }
}
