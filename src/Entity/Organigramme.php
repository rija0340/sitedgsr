<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganigrammeRepository")
 * @Vich\Uploadable()
 */
class Organigramme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @var string|null
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periode;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     *
     * @return Organigramme
     */
    public function setFilename(?string $filename): Organigramme
    {
        $this->filename = $filename;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }
    /**
     * @param null|File $imageFile
     *
     * @return Organigramme
     */
    public function setImageFile(?File $imageFile): Organigramme
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
}
