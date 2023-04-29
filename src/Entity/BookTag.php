<?php

namespace App\Entity;

use App\Repository\BookTagRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookTagRepository::class)
 * * @ORM\Table(name="bookTags")
 */
class BookTag
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bookTags")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id", onDelete="SET NULL")
     */
    private $owner;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publicToOthers;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, inversedBy="tags")
     */
    private $books;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getPublicToOthers(): ?bool
    {
        return $this->publicToOthers;
    }

    public function setPublicToOthers(bool $publicToOthers): self
    {
        $this->publicToOthers = $publicToOthers;

        return $this;
    }


    /**
     * @return ArrayCollection
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBooks(Book $book): void
    {
        $this->books[] = $book;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeTag($this);
        }

        return $this;
    }

}
