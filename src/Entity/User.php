<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *  * @UniqueEntity(
 *     fields={"email"},
 *     message="Je ben reeds geregistreerd, login"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="E-mail is vereist")
     * @Assert\Email(message="E-mail heeft geen geldig formaat")
     */
    private $email;

    // /**
    //  * @ORM\Column(type="json")
    //  */
    // private $roles = [];

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="Voornaam is vereist")
     */
    private $user_firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Paswoord is vereist") 
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="Naam is vereist") 
     */
    private $user_lastname;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="Adres is vereist")
     */
    private $user_adress;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="GSM of telefoon is vereist")
     */
    private $phone;

    /**
     * @ORM\Column(type="integer")
     */
    
    private $gender_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genders", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="datetime")
     */
    private $agreedtermsat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cities", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // // not needed when using bcrypt or argon
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserFirstname(): ?string
    {
        return $this->user_firstname;
    }

    public function setUserFirstname(string $user_firstname): self
    {
        $this->user_firstname = $user_firstname;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUserLastname(): ?string
    {
        return $this->user_lastname;
    }

    public function setUserLastname(string $user_lastname): self
    {
        $this->user_lastname = $user_lastname;

        return $this;
    }

    public function getUserAdress(): ?string
    {
        return $this->user_adress;
    }

    public function setUserAdress(string $user_adress): self
    {
        $this->user_adress = $user_adress;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getGenderId(): ?int
    {
        return $this->gender_id;
    }

    public function setGenderId(int $gender_id): self
    {
        $this->gender_id = $gender_id;

        return $this;
    }

    public function getGender(): ?Genders
    {
        return $this->gender;
    }

    public function setGender(?Genders $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getagreedTermsAt(): ?\DateTimeInterface
    {
        return $this->agreedtermsat;
    }

    public function agreeTerms()
    {
        $this->agreedtermsat = new \DateTime();

        return $this;
    }

    public function getCity(): ?Cities
    {
        return $this->city;
    }

    public function setCity(?Cities $city): self
    {
        $this->city = $city;

        return $this;
    }
}
