<?php

namespace App\Entity;

use App\Repository\PendingRequestGameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PendingRequestGameRepository::class)
 */
class PendingRequestGame
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
    private $status;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=team::class, inversedBy="team_asking")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_asking;

    /**
     * @ORM\ManyToOne(targetEntity=team::class, inversedBy="accepting_team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $accepting_team;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTeamAsking(): ?team
    {
        return $this->team_asking;
    }

    public function setTeamAsking(?team $team_asking): self
    {
        $this->team_asking = $team_asking;

        return $this;
    }

    public function getAcceptingTeam(): ?team
    {
        return $this->accepting_team;
    }

    public function setAcceptingTeam(?team $accepting_team): self
    {
        $this->accepting_team = $accepting_team;

        return $this;
    }
}
