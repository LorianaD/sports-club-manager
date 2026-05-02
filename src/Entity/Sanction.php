<?php

namespace App\Entity;

use App\Repository\SanctionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SanctionRepository::class)]
class Sanction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    #[ORM\Column(length: 255)]
    private ?string $reason = null;

    #[ORM\ManyToOne(inversedBy: 'sanctions')]
    private ?Events $match_context = null;

    #[ORM\ManyToOne(inversedBy: 'sanctions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeImmutable $create_at): static
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getMatchContext(): ?Events
    {
        return $this->match_context;
    }

    public function setMatchContext(?Events $match_context): static
    {
        $this->match_context = $match_context;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }
}
