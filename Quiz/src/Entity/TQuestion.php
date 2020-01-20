<?php

namespace App\Entity;

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
}
