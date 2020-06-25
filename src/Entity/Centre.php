<?php

namespace App\Entity;

use App\Entity\Centre;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CentreRepository")
 *  @UniqueEntity("adresse")
 * @Vich\Uploadable()
 */
class Centre
{
    const TYPE = [

        0 => 'Visite Technique',
        1 => 'Réception Technique'
    ];


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade_cc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_cc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_cc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="centres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $annexe;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeType() : string{
        return self::Type[$this->type];
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getGradeCc(): ?string
    {
        return $this->grade_cc;
    }

    public function setGradeCc(string $grade_cc): self
    {
        $this->grade_cc = $grade_cc;

        return $this;
    }

    public function getNomCc(): ?string
    {
        return $this->nom_cc;
    }

    public function setNomCc(string $nom_cc): self
    {
        $this->nom_cc = $nom_cc;

        return $this;
    }

    public function getNumCc(): ?string
    {
        return $this->num_cc;
    }

    public function setNumCc(string $num_cc): self
    {
        $this->num_cc = $num_cc;

        return $this;
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

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @param null|File $imageFile
     *
     * @return Centre
     */
    public function setImageFile(?File $imageFile): Centre
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

       public function getAnnexe(): ?bool
       {
           return $this->annexe;
       }

       public function setAnnexe(bool $annexe): self
       {
           $this->annexe = $annexe;

           return $this;
       }

     /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getAdresse();
    }



}
