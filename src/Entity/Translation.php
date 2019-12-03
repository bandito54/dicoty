<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 */
class Translation
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
    private $Tr_text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lang", inversedBy="translations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $LangId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Word", inversedBy="translation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $WordId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="translations")
     */
    private $ThemeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrtext(): ?string
    {
        return $this->Tr_text;
    }

    public function setTrtext(string $Tr_text): self
    {
        $this->Tr_text = $Tr_text;

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

    public function getWordId(): ?Word
    {
        return $this->WordId;
    }

    public function setWordId(Word $WordId): self
    {
        $this->WordId = $WordId;

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
}
