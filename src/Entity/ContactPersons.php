<?php

namespace App\Entity;

use App\Repository\ContactPersonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactPersonsRepository::class)]
class ContactPersons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 6)]
    private ?string $pc = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $phone_number = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, PlayerContact>
     */
    #[ORM\OneToMany(targetEntity: PlayerContact::class, mappedBy: 'contactPerson')]
    private Collection $playerContacts;

    public function __construct()
    {
        $this->playerContacts = new ArrayCollection();
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

    public function setPc(string $pc): static
    {
        $this->pc = $pc;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): static
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

    public function setEmail(string $email): static
    {
        $this->email = $email;

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
            $playerContact->setContactPerson($this);
        }

        return $this;
    }

    public function removePlayerContact(PlayerContact $playerContact): static
    {
        if ($this->playerContacts->removeElement($playerContact)) {
            // set the owning side to null (unless already changed)
            if ($playerContact->getContactPerson() === $this) {
                $playerContact->setContactPerson(null);
            }
        }

        return $this;
    }
}
