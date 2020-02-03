<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TUserScoreRepository")
 */
class TUserScore
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $scoScore;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\TUser", inversedBy="tUserScore", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScoScore(): ?float
    {
        return $this->scoScore;
    }

    public function setScoScore(float $scoScore): self
    {
        $this->scoScore = $scoScore;

        return $this;
    }

    public function getUser(): ?TUser
    {
        return $this->user;
    }

    public function setUser(TUser $user): self
    {
        $this->user = $user;

        return $this;
    }
}
