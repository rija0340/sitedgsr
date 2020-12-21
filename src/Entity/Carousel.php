<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CarouselRepository")
 * @Vich\Uploadable()
 */
class Carousel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="carousel_image", fileNameProperty="filename")
     */
    private $imageFile;


   

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    // public function __construct()
    // {
    //  $this->createdAt = new \Datetime();
    //  $this->updatedAt = new \Datetime();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }


    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Carousel
     */
    public function setImageFile(?File $imageFile): Carousel
    {
        $this->imageFile = $imageFile;


        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \Datetime('now');            
        }

        return $this;
    }

        public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

       /**
     * @param null|Datetime 
     *
     * @return self
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
