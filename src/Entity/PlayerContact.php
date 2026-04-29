<?php

namespace App\Entity;

use App\Repository\PlayerContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerContactRepository::class)]
class PlayerContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $relationType = null;

    #[ORM\ManyToOne(inversedBy: 'playerContacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'playerContacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContactPersons $contactPerson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelationType(): ?string
    {
        return $this->relationType;
    }

    public function setRelationType(?string $relationType): static
    {
        $this->relationType = $relationType;

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

    public function getContactPerson(): ?ContactPersons
    {
        return $this->contactPerson;
    }

    public function setContactPerson(?ContactPersons $contactPerson): static
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }
}
