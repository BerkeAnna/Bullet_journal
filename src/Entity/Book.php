<?php

namespace App\Entity;

use App\Repository\BookRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 * * @ORM\Table(name="books")
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opinion;

//    /**
//     * @ORM\Column(type="double", nullable=true)
//     */
//    private $stars;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\ManyToMany(targetEntity=BookTag::class, inversedBy="books")
     * @ORM\JoinTable(name="tags")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=BookCategory::class, inversedBy="books")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity=ReadingTracker::class)
     * @ORM\JoinColumn(name="readingTracker", referencedColumnName="id", onDelete="SET NULL")
     */
    private $readingTracker;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="books")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id", onDelete="SET NULL")
     */
    private $owner;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $stars;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
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

    public function getOpinion(): ?string
    {
        return $this->opinion;
    }

    public function setOpinion(?string $opinion): self
    {
        $this->opinion = $opinion;

        return $this;
    }

//    public function getStars(): ?int
//    {
//        return $this->stars;
//    }
//
//    public function setStars(?int $stars): self
//    {
//        $this->stars = $stars;
//
//        return $this;
//    }

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, BookTag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(BookTag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->setBook($this);
        }

        return $this;
    }

    public function removeTag(BookTag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getBook() === $this) {
                $tag->setBook(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?BookCategory
    {
        return $this->category;
    }

    public function setCategory(?BookCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getReadingTracker(): ?ReadingTracker
    {
        return $this->readingTracker;
    }

    public function setReadingTracker(?ReadingTracker $readingTracker): self
    {
        $this->readingTracker = $readingTracker;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getStars(): ?float
    {
        return $this->stars;
    }

    public function setStars(?float $stars): self
    {
        $this->stars = $stars;

        return $this;
    }
}
