<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DGRepository")
 * 
 * @Vich\Uploadable()

 */
class DG
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade;

    /**
     *@var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="dg_image", fileNameProperty="filename")
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DgWord", mappedBy="dg")
     */
    private $dgWords;

    public function __construct()
    {
        $this->dgWords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }


    /**
     * @param string|null $filename
     *
     * @return DG
     */
    public function setFilename(?string $filename): DG
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
     * @return DG
     */
    public function setImageFile(?File $imageFile): DG
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



    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection|DgWord[]
     */
    public function getDgWords(): Collection
    {
        return $this->dgWords;
    }

    public function addDgWord(DgWord $dgWord): self
    {
        if (!$this->dgWords->contains($dgWord)) {
            $this->dgWords[] = $dgWord;
            $dgWord->setDg($this);
        }

        return $this;
    }

    public function removeDgWord(DgWord $dgWord): self
    {
        if ($this->dgWords->contains($dgWord)) {
            $this->dgWords->removeElement($dgWord);
            // set the owning side to null (unless already changed)
            if ($dgWord->getDg() === $this) {
                $dgWord->setDg(null);
            }
        }

        return $this;
    }
}
