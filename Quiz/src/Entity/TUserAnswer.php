<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TUserAnswerRepository")
 */
class TUserAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TAnswer", inversedBy="tUserAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $answer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?TAnswer
    {
        return $this->answer;
    }

    public function setAnswer(?TAnswer $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
