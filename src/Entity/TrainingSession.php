<?php

namespace App\Entity;

use App\Repository\TrainingSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingSessionRepository::class)]
class TrainingSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $time = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'trainingSessions')]
    private Collection $coach;

    public function __construct()
    {
        $this->coach = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTime
    {
        return $this->time;
    }

    public function setTime(\DateTime $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getCoach(): Collection
    {
        return $this->coach;
    }

    public function addCoach(User $coach): static
    {
        if (!$this->coach->contains($coach)) {
            $this->coach->add($coach);
        }

        return $this;
    }

    public function removeCoach(User $coach): static
    {
        $this->coach->removeElement($coach);

        return $this;
    }
}
