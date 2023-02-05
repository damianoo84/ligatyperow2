<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\Column(type="string", length=20)
     */
    private $username;

    /**
     *
     * @ORM\Column(type="string", length=20 , unique = true)
     */
    private $shortname;

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

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $phone;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfWins;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastActivityAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rankingPosition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPointsPerQueue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPointsPerQueue;

    /**
     * @ORM\Column(type="string", length=20,  nullable=true)
     */
    private $nick;
    
    /**
     * @ORM\Column(type="string", length=20,  nullable=true)
    */
    private $favoritePolandTeam;
    
    /**
     * @ORM\Column(type="string", length=20,  nullable=true)
    */
    private $favoriteForeignTeam;
    
    /**
     * @ORM\Column(type="integer",  nullable=true)
    */
    private $numberOfFirstPlaces;
    
    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $numberOfSecondPlaces;
    
    /**
     * @ORM\Column(type="integer",  nullable=true)
    */
    private $numberOfThirdPlaces;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $lastWinner;
    
    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $liderOfRanking;
    
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



    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getShortname()
    {
        return $this->shortname;
    }

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
        return (string) $this->username;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getNumberOfWins(): ?int
    {
        return $this->numberOfWins;
    }

    public function setNumberOfWins(int $numberOfWins): self
    {
        $this->numberOfWins = $numberOfWins;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getLastActivityAt(): ?\DateTimeInterface
    {
        return $this->lastActivityAt;
    }

    public function setLastActivityAt(?\DateTimeInterface $lastActivityAt): self
    {
        $this->lastActivityAt = $lastActivityAt;

        return $this;
    }

    public function getRankingPosition(): ?int
    {
        return $this->rankingPosition;
    }

    public function setRankingPosition(int $rankingPosition): self
    {
        $this->rankingPosition = $rankingPosition;

        return $this;
    }

    public function getMaxPointsPerQueue(): ?int
    {
        return $this->maxPointsPerQueue;
    }

    public function setMaxPointsPerQueue(int $maxPointsPerQueue): self
    {
        $this->maxPointsPerQueue = $maxPointsPerQueue;

        return $this;
    }

    public function getMinPointsPerQueue(): ?int
    {
        return $this->minPointsPerQueue;
    }

    public function setMinPointsPerQueue(int $minPointsPerQueue): self
    {
        $this->minPointsPerQueue = $minPointsPerQueue;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Bool Whether the user is active or not
     */
    public function isActiveNow()
    {
        // Delay during wich the user will be considered as still active
        $delay = new \DateTime('2 minutes ago');
        return ( $this->getLastActivityAt() > $delay );
    }
    
    public function getNick() {
        return $this->nick;
    }

    public function setNick($nick): void {
        $this->nick = $nick;
    }

    public function getFavoritePolandTeam() {
        return $this->favoritePolandTeam;
    }

    public function getFavoriteForeignTeam() {
        return $this->favoriteForeignTeam;
    }

    public function getNumberOfFirstPlaces() {
        return $this->numberOfFirstPlaces;
    }

    public function getNumberOfSecondPlaces() {
        return $this->numberOfSecondPlaces;
    }

    public function getNumberOfThirdPlaces() {
        return $this->numberOfThirdPlaces;
    }

    public function setFavoritePolandTeam($favoritePolandTeam): void {
        $this->favoritePolandTeam = $favoritePolandTeam;
    }

    public function setFavoriteForeignTeam($favoriteForeignTeam): void {
        $this->favoriteForeignTeam = $favoriteForeignTeam;
    }

    public function setNumberOfFirstPlaces($numberOfFirstPlaces): void {
        $this->numberOfFirstPlaces = $numberOfFirstPlaces;
    }

    public function setNumberOfSecondPlaces($numberOfSecondPlaces): void {
        $this->numberOfSecondPlaces = $numberOfSecondPlaces;
    }

    public function setNumberOfThirdPlaces($numberOfThirdPlaces): void {
        $this->numberOfThirdPlaces = $numberOfThirdPlaces;
    }

    public function getLastWinner() {
        return $this->lastWinner;
    }

    public function getLiderOfRanking() {
        return $this->liderOfRanking;
    }

    public function setLastWinner($lastWinner): void {
        $this->lastWinner = $lastWinner;
    }

    public function setLiderOfRanking($liderOfRanking): void {
        $this->liderOfRanking = $liderOfRanking;
    }



}
