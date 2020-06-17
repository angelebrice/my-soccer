<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
    private $goal_for;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goal_against;

    /**
     * @ORM\OneToMany(targetEntity=Tchat::class, mappedBy="game")
     */
    private $tchats;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="home_team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $home_team;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="outside_team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $outside_team;

    public function __construct()
    {
        $this->tchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoalFor(): ?int
    {
        return $this->goal_for;
    }

    public function setGoalFor(?int $goal_for): self
    {
        $this->goal_for = $goal_for;

        return $this;
    }

    public function getGoalAgainst(): ?int
    {
        return $this->goal_against;
    }

    public function setGoalAgainst(?int $goal_against): self
    {
        $this->goal_against = $goal_against;

        return $this;
    }

    /**
     * @return Collection|Tchat[]
     */
    public function getTchats(): Collection
    {
        return $this->tchats;
    }

    public function addTchat(Tchat $tchat): self
    {
        if (!$this->tchats->contains($tchat)) {
            $this->tchats[] = $tchat;
            $tchat->setGame($this);
        }

        return $this;
    }

    public function removeTchat(Tchat $tchat): self
    {
        if ($this->tchats->contains($tchat)) {
            $this->tchats->removeElement($tchat);
            // set the owning side to null (unless already changed)
            if ($tchat->getGame() === $this) {
                $tchat->setGame(null);
            }
        }

        return $this;
    }

    public function getHomeTeam(): ?team
    {
        return $this->home_team;
    }

    public function setHomeTeam(?team $home_team): self
    {
        $this->home_team = $home_team;

        return $this;
    }

    public function getOutsideTeam(): ?team
    {
        return $this->outside_team;
    }

    public function setOutsideTeam(?team $outside_team): self
    {
        $this->outside_team = $outside_team;

        return $this;
    }
}
