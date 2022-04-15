<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

#[Table(name: 'corenthin_projet6_user')]
#[Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(
    fields: ['email'],
    errorPath: 'email',
    message: 'This email is already used.'
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string')]
    private string $username;

    #[Column(type: 'string', unique: true)]
    #[Email(message: 'Email not valid')]
    private string $email;

    #[Column(type: 'string')]
    #[Length(min: 6, minMessage: 'Password need to be at least 6 characters')]
    private string $password;

    #[Column(type: 'json')]
    private array $roles;

    #[ManyToOne(targetEntity: 'App\Entity\Media')]
    #[JoinColumn(name: 'media_id', referencedColumnName: 'id', nullable: true)]
    private Media $media;

    #[Column(type: 'string', nullable: true)]
    private string $token;

    #[Column(type: 'boolean')]
    private $isVerified;

    public function __toString()
    {
        return $this->username;
    }

    public function __construct()
    {
        $this->roles[] = 'ROLE_USER';
        $this->isVerified = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getIsVerified()
    {
        return $this->isVerified;
    }

    public function getUserIdentifier()
    {
        return $this->email;
    }

    public function getSalt()
    {
        return;
    }
    
    public function eraseCredentials()
    {
        return;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the value of media
     *
     * @return  self
     */ 
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Set the value of isVerified
     *
     * @return  self
     */ 
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}