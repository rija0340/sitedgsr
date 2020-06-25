<?php

namespace App\Entity;

use App\Entity\Actualite;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActualiteRepository")
 * @UniqueEntity("title") 
 * @Vich\Uploadable()
 */
class Actualite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;


    /**
     * @var File|null
     * @Vich\UploadableField(mapping="actualite_image", fileNameProperty="filename")
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     */
    private $url_video;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePub;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attachement", mappedBy="actualite", cascade={"persist", "remove"})
     */
    private $attachements;



    public function __construct()
    {
        
        $this->attachements = new ArrayCollection();

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     *
     * @return Actualite
     */
    public function setFilename(?string $filename): Actualite
    {
        $this->filename = $filename;

        return $this;
    }

   
    public function getUrlVideo(): ?string
    {
        return $this->url_video;
    }

    public function setUrlVideo(string $url_video): self
    {
        $this->url_video = $url_video;

        return $this;
    }


    /**
     * @param null|File $imageFile
     *
     * @return Actualite
     */
    public function setImageFile(?File $imageFile): Actualite
    {
        $this->imageFile = $imageFile;
        
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \Datetime('now');            
        }

        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }



    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

       /**
     * @param null|Datetime 
     *
     * @return self
     */
       public function setUpdatedAt(\DateTimeInterface $updated_at): self
       {
        $this->updated_at = $updated_at;

        return $this;
    }

     
        public function getDatePub(): ?\DateTimeInterface
        {
         return $this->datePub;
     }

     public function setDatePub(\DateTimeInterface $datePub): self
     {
         $this->datePub = $datePub;

         return $this;
     }

     /**
     * @return Collection|Attachement[]
     */
    public function getAttachements(): Collection
    {
        return $this->attachements;
    }

    public function addAttachement(Attachement $attachement): self
    {
        if (!$this->attachements->contains($attachement)) {
            $this->attachements[] = $attachement;
            $attachement->setActualite($this);
        }

        return $this;
    }

    public function removeAttachement(Attachement $attachement): self
    {
        if ($this->attachements->contains($attachement)) {
            $this->attachements->removeElement($attachement);
            // set the owning side to null (unless already changed)
            if ($attachement->getActualite() === $this) {
                $attachement->setActualite(null);
            }
        }

        return $this;
    }

 }
