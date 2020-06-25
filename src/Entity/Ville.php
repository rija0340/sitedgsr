<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
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
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Centre", mappedBy="ville")
     */
    private $centres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Faritany", inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $faritany;

    public function __construct()
    {
        $this->centres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|Centre[]
     */
    public function getCentres(): Collection
    {
        return $this->centres;
    }

    public function addCentre(Centre $centre): self
    {
        if (!$this->centres->contains($centre)) {
            $this->centres[] = $centre;
            $centre->setVille($this);
        }

        return $this;
    }

    public function removeCentre(Centre $centre): self
    {
        if ($this->centres->contains($centre)) {
            $this->centres->removeElement($centre);
            // set the owning side to null (unless already changed)
            if ($centre->getVille() === $this) {
                $centre->setVille(null);
            }
        }

        return $this;
    }

    public function getFaritany(): ?Faritany
    {
        return $this->faritany;
    }

    public function setFaritany(?Faritany $faritany): self
    {
        $this->faritany = $faritany;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getVille();
    }

}
