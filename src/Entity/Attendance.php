<?php

namespace App\Entity;

use App\Repository\AttendanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttendanceRepository::class)]
class Attendance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    #[ORM\ManyToOne(inversedBy: 'attendances')]
    private ?AttendanceStatus $attendance_status = null;

    #[ORM\ManyToOne(inversedBy: 'attendances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

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

    public function getAttendanceStatus(): ?AttendanceStatus
    {
        return $this->attendance_status;
    }

    public function setAttendanceStatus(?AttendanceStatus $attendance_status): static
    {
        $this->attendance_status = $attendance_status;

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
