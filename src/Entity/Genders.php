<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GendersRepository")
 */
class Genders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=18)
     */
    private $gender_name;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $gender_abbreviation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="gender")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenderName(): ?string
    {
        return $this->gender_name;
    }

    public function setGenderName(string $gender_name): self
    {
        $this->gender_name = $gender_name;

        return $this;
    }

    public function getGenderAbbreviation(): ?string
    {
        return $this->gender_abbreviation;
    }

    public function setGenderAbbreviation(string $gender_abbreviation): self
    {
        $this->gender_abbreviation = $gender_abbreviation;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGender($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getGender() === $this) {
                $user->setGender(null);
            }
        }

        return $this;
    }

    public function __toString(){
        // to show the shortname of the Gender in the select
        return $this->gender_abbreviation;
        // to show the abbreviation of the Gender in the select
    }



}
