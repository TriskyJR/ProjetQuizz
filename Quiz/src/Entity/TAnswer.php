<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TAnswerRepository")
 */
class TAnswer
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
    private $ansTitle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ansTrueFalse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TQuestion", inversedBy="tAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    public function __construct()
    {
        $this->tUserAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnsTitle(): ?string
    {
        return $this->ansTitle;
    }

    public function setAnsTitle(string $ansTitle): self
    {
        $this->ansTitle = $ansTitle;

        return $this;
    }

    public function getAnsTrueFalse(): ?bool
    {
        return $this->ansTrueFalse;
    }

    public function setAnsTrueFalse(bool $ansTrueFalse): self
    {
        $this->ansTrueFalse = $ansTrueFalse;

        return $this;
    }

    public function getQuestion(): ?TQuestion
    {
        return $this->question;
    }

    public function setQuestion(?TQuestion $question): self
    {
        $this->question = $question;

        return $this;
    }
}
