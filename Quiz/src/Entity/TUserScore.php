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
}
