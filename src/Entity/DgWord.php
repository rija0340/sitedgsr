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
     * @ORM\Column(type="text",nullable=true)
     */
    private $word;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DG", inversedBy="dgWords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dg;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $word_gasy;

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

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getWord();
    }

    public function getWordGasy(): ?string
    {
        return $this->word_gasy;
    }

    public function setWordGasy(?string $word_gasy): self
    {
        $this->word_gasy = $word_gasy;

        return $this;
    }
}
