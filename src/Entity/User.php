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

#[Table(name: 'corenthin_projet6_user')]
#[Entity(repositoryClass: UserRepository::class)]

class User
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string')]
    private string $username;

    #[Column(type: 'string')]
    private string $email;

    #[Column(type: 'string')]
    private string $password;

    #[Column(type: 'json')]
    private array $roles;

    #[ManyToOne(targetEntity: 'App\Entity\Media')]
    #[JoinColumn(name: 'media_id', referencedColumnName: 'id', nullable: true)]
    private Media $media;

    public function __toString()
    {
        return $this->username;
    }

    public function __construct()
    {
        $this->roles[] = 'ROLE_USER';
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
}