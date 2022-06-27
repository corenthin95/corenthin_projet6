<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Table(name: 'corenthin_projet6_picture')]
#[Entity()]

class Picture
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string')]
    private string $filename;

    #[Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[Column(type: 'string', nullable: true)]
    private string $alt;

    #[NotBlank(message: 'Image required.')]
    #[File(mimeTypes: 'image/png', maxSize: '2M')]
    private ?UploadedFile $file;

    #[ManyToOne(targetEntity: 'App\Entity\Trick', inversedBy: 'image')]
    #[JoinColumn(name: 'trick_id', referencedColumnName: 'id', nullable: true)]
    private ?Trick $trick;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of type
     */ 
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the value of alt
     */ 
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Get the value of trick
     */ 
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Set the value of alt
     *
     * @return  self
     */ 
    public function setAlt($alt)
    {
        $this->alt = $alt;

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

    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}