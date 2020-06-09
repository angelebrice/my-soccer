<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="home_team")
     */
    private $home_team;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="outside_team")
     */
    private $outside_team;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=PendingRequestGame::class, mappedBy="team_asking")
     */
    private $team_asking;

    /**
     * @ORM\OneToMany(targetEntity=PendingRequestGame::class, mappedBy="accepting_team")
     */
    private $accepting_team;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Team_lead;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="team")
     */
    private $User;

    public function __construct()
    {
        $this->home_team = new ArrayCollection();
        $this->outside_team = new ArrayCollection();
        $this->team_asking = new ArrayCollection();
        $this->accepting_team = new ArrayCollection();
        $this->User = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setHomeTeam($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->contains($game)) {
            $this->games->removeElement($game);
            // set the owning side to null (unless already changed)
            if ($game->getHomeTeam() === $this) {
                $game->setHomeTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getOutsideTeam(): Collection
    {
        return $this->outside_team;
    }

    public function addOutsideTeam(Game $outsideTeam): self
    {
        if (!$this->outside_team->contains($outsideTeam)) {
            $this->outside_team[] = $outsideTeam;
            $outsideTeam->setOutsideTeam($this);
        }

        return $this;
    }

    public function removeOutsideTeam(Game $outsideTeam): self
    {
        if ($this->outside_team->contains($outsideTeam)) {
            $this->outside_team->removeElement($outsideTeam);
            // set the owning side to null (unless already changed)
            if ($outsideTeam->getOutsideTeam() === $this) {
                $outsideTeam->setOutsideTeam(null);
            }
        }

        return $this;
    }

    public function getCity(): ?city
    {
        return $this->city;
    }

    public function setCity(?city $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|PendingRequestGame[]
     */
    public function getTeamAsking(): Collection
    {
        return $this->team_asking;
    }

    public function addTeamAsking(PendingRequestGame $teamAsking): self
    {
        if (!$this->team_asking->contains($teamAsking)) {
            $this->team_asking[] = $teamAsking;
            $teamAsking->setTeamAsking($this);
        }

        return $this;
    }

    public function removeTeamAsking(PendingRequestGame $teamAsking): self
    {
        if ($this->team_asking->contains($teamAsking)) {
            $this->team_asking->removeElement($teamAsking);
            // set the owning side to null (unless already changed)
            if ($teamAsking->getTeamAsking() === $this) {
                $teamAsking->setTeamAsking(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PendingRequestGame[]
     */
    public function getAcceptingTeam(): Collection
    {
        return $this->accepting_team;
    }

    public function addAcceptingTeam(PendingRequestGame $acceptingTeam): self
    {
        if (!$this->accepting_team->contains($acceptingTeam)) {
            $this->accepting_team[] = $acceptingTeam;
            $acceptingTeam->setAcceptingTeam($this);
        }

        return $this;
    }

    public function removeAcceptingTeam(PendingRequestGame $acceptingTeam): self
    {
        if ($this->accepting_team->contains($acceptingTeam)) {
            $this->accepting_team->removeElement($acceptingTeam);
            // set the owning side to null (unless already changed)
            if ($acceptingTeam->getAcceptingTeam() === $this) {
                $acceptingTeam->setAcceptingTeam(null);
            }
        }

        return $this;
    }

    public function getTeamLead(): ?user
    {
        return $this->Team_lead;
    }

    public function setTeamLead(user $Team_lead): self
    {
        $this->Team_lead = $Team_lead;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(User $user): self
    {
        if (!$this->User->contains($user)) {
            $this->User[] = $user;
            $user->setTeam($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->User->contains($user)) {
            $this->User->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getTeam() === $this) {
                $user->setTeam(null);
            }
        }

        return $this;
    }
}
