<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 */
class Theme
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
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Picture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="themes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Word", mappedBy="ThemeId", orphanRemoval=true)
     */
    private $words;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Translation", mappedBy="ThemeId")
     */
    private $translations;



    public function __construct()
    {
        $this->Word = new ArrayCollection();
        $this->words = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->UserId;
    }

    public function setUserId(?User $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    /**
     * @return Collection|Word[]
     */
    public function getWord(): Collection
    {
        return $this->Word;
    }

    public function addWord(Word $Word): self
    {
        if (!$this->Word->contains($Word)) {
            $this->Word[] = $Word;
            $Word->setThemeId($this);
        }

        return $this;
    }

    public function removeWord(Word $Word): self
    {
        if ($this->Word->contains($Word)) {
            $this->Word->removeElement($Word);
            // set the owning side to null (unless already changed)
            if ($Word->getThemeId() === $this) {
                $Word->setThemeId(null);
            }
        }

        return $this;
    }

    public function getWords(): ?Word
    {
        return $this->words;
    }

    public function setWords(Word $words): self
    {
        $this->words = $words;

        // set the owning side of the relation if necessary
        if ($this !== $words->getThemeId()) {
            $words->setThemeId($this);
        }

        return $this;
    }

    /**
     * @return Collection|Translation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(Translation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setThemeId($this);
        }

        return $this;
    }

    public function removeTranslation(Translation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getThemeId() === $this) {
                $translation->setThemeId(null);
            }
        }

        return $this;
    }
}
