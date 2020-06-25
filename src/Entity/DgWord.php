<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DgWordRepository")
 */
class DgWord
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="text")
     */
    private $word;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DG", inversedBy="dgWords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dg;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getDg(): ?DG
    {
        return $this->dg;
    }

    public function setDg(?DG $dg): self
    {
        $this->dg = $dg;

        return $this;
    }
}
