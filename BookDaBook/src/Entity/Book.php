<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Le livre doit avoir au moins {{ limit }} caractères",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 5000,
     *      minMessage = "Vous devez avoir au minimum {{ limit }} page pour votre livre",
     *      maxMessage = "votre livre ne peut dépasser {{ limit }} pages"
     * )
     */
    private $pageNbr;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $sample;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom de l'auteur ne peut pas contenir de chiffre"
     * )
     */
    private $writer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $editerName;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1800,
     *      max = 2020,
     *      minMessage = "L'année doit être après {{ limit }}",
     *      maxMessage = "L'année doit être avant {{ limit }}"
     * )
     */
    private $editionYear;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     * message = "L'url {{ value }} n'est pas une url valide",
     * )
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="book")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rate", mappedBy="book")
     */
    private $rates;

    public function __construct()
    {
        $this->rates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPageNbr(): ?int
    {
        return $this->pageNbr;
    }

    public function setPageNbr(int $pageNbr): self
    {
        $this->pageNbr = $pageNbr;

        return $this;
    }

    public function getSample(): ?string
    {
        return $this->sample;
    }

    public function setSample(string $sample): self
    {
        $this->sample = $sample;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getWriter(): ?string
    {
        return $this->writer;
    }

    public function setWriter(string $writer): self
    {
        $this->writer = $writer;

        return $this;
    }

    public function getEditerName(): ?string
    {
        return $this->editerName;
    }

    public function setEditerName(string $editerName): self
    {
        $this->editerName = $editerName;

        return $this;
    }

    public function getEditionYear(): ?int
    {
        return $this->editionYear;
    }

    public function setEditionYear(int $editionYear): self
    {
        $this->editionYear = $editionYear;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setBook($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->contains($rate)) {
            $this->rates->removeElement($rate);
            // set the owning side to null (unless already changed)
            if ($rate->getBook() === $this) {
                $rate->setBook(null);
            }
        }

        return $this;
    }
}
