<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LabelCouvertureRepository")
 */
class LabelCouverture
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImagesEntete", mappedBy="labelCouverture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $imagesentete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getImagesentete(): ?ImagesEntete
    {
        return $this->imagesentete;
    }

    public function setImagesentete(ImagesEntete $imagesentete): self
    {
        $this->imagesentete = $imagesentete;

        return $this;
    }
        /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getLabel();
    }
}
