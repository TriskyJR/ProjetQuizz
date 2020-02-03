<?php

namespace App\Entity;

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
     * @ORM\OneToOne(targetEntity="App\Entity\TUserScore", mappedBy="user", cascade={"persist", "remove"})
     */
    private $tUserScore;

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

    public function getTUserScore(): ?TUserScore
    {
        return $this->tUserScore;
    }

    public function setTUserScore(TUserScore $tUserScore): self
    {
        $this->tUserScore = $tUserScore;

        // set the owning side of the relation if necessary
        if ($tUserScore->getUser() !== $this) {
            $tUserScore->setUser($this);
        }

        return $this;
    }

}
