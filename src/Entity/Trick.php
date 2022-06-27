<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\Common\Collections\Collection;

#[Table(name: 'corenthin_projet6_trick')]
#[Entity(repositoryClass: TrickRepository::class)]
#[UniqueEntity(
    fields: ['name'],
    errorPath: 'email',
    message: 'This trick already exist.'
)]

class Trick
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[Column(type: 'datetime')]
    private \DateTime $updatedAt;

    #[Column(type: 'string')]
    private string $slug;

    #[Column(type: 'string')]
    #[NotBlank(message: 'Name required.')]
    private string $name;

    #[Column(type: 'text')]
    #[NotBlank(message: 'Description required.')]
    private string $description;

    #[OneToMany(targetEntity: 'App\Entity\Picture', mappedBy: 'trick', cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'picture_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Collection $image;

    #[OneToMany(targetEntity: 'App\Entity\Video', mappedBy: 'trick', cascade: ['persist'])]
    #[JoinColumn(name: 'video_id', referencedColumnName: 'id')]
    private Collection $video;

    #[OneToMany(targetEntity: 'App\Entity\Comment', mappedBy: 'trick', cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'comment_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Collection $comment;

    #[ManyToOne(targetEntity: 'App\Entity\User')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    #[ManyToOne(targetEntity: 'App\Entity\Category')]
    #[JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private Category $category;

    #[Column(type: 'string', nullable: true)]
    private $mainImage;

    /**
     * Get the value of mainImage
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * Set the value of mainImage
     *
     * @return  self
     */
    public function setMainImage($mainImage)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->comment = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->video = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * Get the value of updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of image
     * @return ArrayCollection
     */
    public function getImage()
    {
        return $this->image;
    }

    public function addImage(Picture $picture)
    {
        if (!$this->image->contains($picture)) {
            $this->image->add($picture);
            $picture->setTrick($this);
        }
    }

    public function removeImage(Picture $picture)
    {
        if ($this->image->contains($picture)) {
            $this->image->removeElement($picture);
        }
    }

    /**
     * Get the value of video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Get the value of comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Set the value of video
     *
     * @return  self
     */
    public function setVideo($video)
    {
        $this->video = $video;

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
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
