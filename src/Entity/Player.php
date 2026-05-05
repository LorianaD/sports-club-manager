<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $birth_date = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $number = null;    

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 6, nullable: true)]
    private ?string $pc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $license_number = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $photo = null;

    /**
     * @var Collection<int, PlayerContact>
     */
    #[ORM\OneToMany(targetEntity: PlayerContact::class, mappedBy: 'player')]
    private Collection $playerContacts;

    /**
     * @var Collection<int, Attendance>
     */
    #[ORM\OneToMany(targetEntity: Attendance::class, mappedBy: 'player')]
    private Collection $attendances;

    /**
     * @var Collection<int, Sanction>
     */
    #[ORM\OneToMany(targetEntity: Sanction::class, mappedBy: 'player')]
    private Collection $sanctions;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Team $team = null;

    /**
     * @var Collection<int, Position>
     */
    #[ORM\ManyToMany(targetEntity: Position::class, inversedBy: 'players')]
    private Collection $position;

    public function __construct()
    {
        $this->playerContacts = new ArrayCollection();
        $this->attendances = new ArrayCollection();
        $this->sanctions = new ArrayCollection();
        $this->position = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeImmutable $birth_date): static
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getAge()
    {
        if (!$this->birth_date) {
            return null;
        }

        $today = new \DateTime();
        
        return $this->birth_date->diff($today)->y;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPc(): ?string
    {
        return $this->pc;
    }

    public function setPc(?string $pc): static
    {
        $this->pc = $pc;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): static
    {
        if ($phone_number !== null) {
            $phone_number = preg_replace('/\D/', '', $phone_number);
        }

        $this->phone_number = $phone_number;

        return $this;
    }

    public function getFormattedPhoneNumber(): ?string
    {
        if ($this->phone_number === null) {
            return null;
        }

        return trim(chunk_split($this->phone_number, 2, ' '));
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getLicenseNumber(): ?string
    {
        return $this->license_number;
    }

    public function setLicenseNumber(?string $license_number): static
    {
        $this->license_number = $license_number;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, PlayerContact>
     */
    public function getPlayerContacts(): Collection
    {
        return $this->playerContacts;
    }

    public function addPlayerContact(PlayerContact $playerContact): static
    {
        if (!$this->playerContacts->contains($playerContact)) {
            $this->playerContacts->add($playerContact);
            $playerContact->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerContact(PlayerContact $playerContact): static
    {
        if ($this->playerContacts->removeElement($playerContact)) {
            // set the owning side to null (unless already changed)
            if ($playerContact->getPlayer() === $this) {
                $playerContact->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Attendance>
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendance(Attendance $attendance): static
    {
        if (!$this->attendances->contains($attendance)) {
            $this->attendances->add($attendance);
            $attendance->setPlayer($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): static
    {
        if ($this->attendances->removeElement($attendance)) {
            // set the owning side to null (unless already changed)
            if ($attendance->getPlayer() === $this) {
                $attendance->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sanction>
     */
    public function getSanctions(): Collection
    {
        return $this->sanctions;
    }

    public function addSanction(Sanction $sanction): static
    {
        if (!$this->sanctions->contains($sanction)) {
            $this->sanctions->add($sanction);
            $sanction->setPlayer($this);
        }

        return $this;
    }

    public function removeSanction(Sanction $sanction): static
    {
        if ($this->sanctions->removeElement($sanction)) {
            // set the owning side to null (unless already changed)
            if ($sanction->getPlayer() === $this) {
                $sanction->setPlayer(null);
            }
        }

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

        return $this;
    }

    /**
     * @return Collection<int, Position>
     */
    public function getPosition(): Collection
    {
        return $this->position;
    }

    public function addPosition(Position $position): static
    {
        if (!$this->position->contains($position)) {
            $this->position->add($position);
        }

        return $this;
    }

    public function removePosition(Position $position): static
    {
        $this->position->removeElement($position);

        return $this;
    }
}
