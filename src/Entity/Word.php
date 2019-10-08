<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WordRepository")
 */
class Word
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
    private $Text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lang", inversedBy="words")
     * @ORM\JoinColumn(nullable=false)
     */
    private $LangId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="words")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ThemeId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Translation", mappedBy="WordId", cascade={"persist", "remove"})
     */
    private $translation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): self
    {
        $this->Text = $Text;

        return $this;
    }

    public function getLangId(): ?Lang
    {
        return $this->LangId;
    }

    public function setLangId(?Lang $LangId): self
    {
        $this->LangId = $LangId;

        return $this;
    }

    public function getThemeId(): ?Theme
    {
        return $this->ThemeId;
    }

    public function setThemeId(?Theme $ThemeId): self
    {
        $this->ThemeId = $ThemeId;

        return $this;
    }

    public function getTranslation(): ?Translation
    {
        return $this->translation;
    }

    public function setTranslation(Translation $translation): self
    {
        $this->translation = $translation;

        // set the owning side of the relation if necessary
        if ($this !== $translation->getWordId()) {
            $translation->setWordId($this);
        }

        return $this;
    }
}
