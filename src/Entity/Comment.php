<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Table(name: 'corenthin_projet6_comment')]
#[Entity()]

class Comment
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[Column(type: 'text')]
    private string $content;

    #[ManyToOne(targetEntity: 'App\Entity\User')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    #[ManyToOne(targetEntity: 'App\Entity\Trick')]
    #[JoinColumn(name: 'trick_id', referencedColumnName: 'id')]
    private Trick $trick;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the value of trick
     */ 
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set the value of trick
     *
     * @return  self
     */ 
    public function setTrick($trick)
    {
        $this->trick = $trick;

        return $this;
    }
}