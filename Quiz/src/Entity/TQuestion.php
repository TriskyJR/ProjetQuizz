<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TQuestionRepository")
 */
class TQuestion
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
    private $queTitle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $queType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TAnswer", mappedBy="question")
     */
    private $tAnswers;

    public function __construct()
    {
        $this->tAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQueTitle(): ?string
    {
        return $this->queTitle;
    }

    public function setQueTitle(string $queTitle): self
    {
        $this->queTitle = $queTitle;

        return $this;
    }

    public function getQueType(): ?bool
    {
        return $this->queType;
    }

    public function setQueType(bool $queType): self
    {
        $this->queType = $queType;

        return $this;
    }

    /**
     * @return Collection|TAnswer[]
     */
    public function getTAnswers(): Collection
    {
        return $this->tAnswers;
    }

    public function addTAnswer(TAnswer $tAnswer): self
    {
        if (!$this->tAnswers->contains($tAnswer)) {
            $this->tAnswers[] = $tAnswer;
            $tAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeTAnswer(TAnswer $tAnswer): self
    {
        if ($this->tAnswers->contains($tAnswer)) {
            $this->tAnswers->removeElement($tAnswer);
            // set the owning side to null (unless already changed)
            if ($tAnswer->getQuestion() === $this) {
                $tAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
