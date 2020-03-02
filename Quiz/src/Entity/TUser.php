<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TUserRepository")
 */
class TUser
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
    private $useUsername;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $useClass;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TUserAnswer", mappedBy="user")
     */
    private $tUserAnswers;

    public function __construct()
    {
        $this->tUserAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUseUsername(): ?string
    {
        return $this->useUsername;
    }

    public function setUseUsername(string $useUsername): self
    {
        $this->useUsername = $useUsername;

        return $this;
    }

    public function getUseClass(): ?string
    {
        return $this->useClass;
    }

    public function setUseClass(string $useClass): self
    {
        $this->useClass = $useClass;

        return $this;
    }

    /**
     * @return Collection|TUserAnswer[]
     */
    public function getTUserAnswers(): Collection
    {
        return $this->tUserAnswers;
    }

    public function addTUserAnswer(TUserAnswer $tUserAnswer): self
    {
        if (!$this->tUserAnswers->contains($tUserAnswer)) {
            $this->tUserAnswers[] = $tUserAnswer;
            $tUserAnswer->setUser($this);
        }

        return $this;
    }

    public function removeTUserAnswer(TUserAnswer $tUserAnswer): self
    {
        if ($this->tUserAnswers->contains($tUserAnswer)) {
            $this->tUserAnswers->removeElement($tUserAnswer);
            // set the owning side to null (unless already changed)
            if ($tUserAnswer->getUser() === $this) {
                $tUserAnswer->setUser(null);
            }
        }

        return $this;
    }
}
