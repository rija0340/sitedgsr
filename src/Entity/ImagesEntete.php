<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesEnteteRepository")
 * @Vich\Uploadable()
 */
class ImagesEntete
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
     * @Vich\UploadableField(mapping="entete_image", fileNameProperty="filename")
     */
    private $imageFile;


    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $updated_at;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LabelCouverture", inversedBy="imagesentete")
     */
    private $labelCouverture;



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
     * @param null|File $imageFile
     *
     * @return ImagesEntete
     */
    public function setImageFile(?File $imageFile): ImagesEntete
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


       public function getLabelCouverture(): ?LabelCouverture
       {
           return $this->labelCouverture;
       }

       public function setLabelCouverture(LabelCouverture $labelCouverture): self
       {
           $this->labelCouverture = $labelCouverture;

           // // set the owning side of the Imagesentete if necessary
           // if ($labelCouverture->getImagesentete() !== $this) {
           //     $labelCouverture->setImagesentete($this);
           // }

           return $this;
       }

               /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getFilename();
    }


}
