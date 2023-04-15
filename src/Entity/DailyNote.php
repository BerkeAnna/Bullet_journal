<?php

namespace App\Entity;

use App\Repository\DailyNoteRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DailyNoteRepository::class)
 * * @ORM\Table(name="dailyNotes")
 */
class DailyNote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $todo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $event;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $nameday;

    /**
     * @ORM\OneToMany(targetEntity=ImageAlbum::class, mappedBy="dailyNotes")
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity=MoodTracker::class)
     * @ORM\JoinColumn(name="moodTracker", referencedColumnName="id", onDelete="SET NULL")
     */
    private $mood;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="dailyNotes")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id", onDelete="SET NULL")
     */
    private $owner;

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTodo(): ?string
    {
        return $this->todo;
    }

    public function setTodo(string $todo): self
    {
        $this->todo = $todo;

        return $this;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(?string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getBirthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getNameday(): ?DateTimeInterface
    {
        return $this->nameday;
    }

    public function setNameday(?DateTimeInterface $nameday): self
    {
        $this->nameday = $nameday;

        return $this;
    }

    /**
     * @return Collection<int, ImageAlbum>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(ImageAlbum $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setDailyNote($this);
        }

        return $this;
    }

    public function removeImage(ImageAlbum $image): self
    {
        if ($this->image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getDailyNote() === $this) {
                $image->setDailyNote(null);
            }
        }

        return $this;
    }

    public function getMood(): ?MoodTracker
    {
        return $this->mood;
    }

    public function setMood(?MoodTracker $mood): self
    {
        $this->mood = $mood;

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
}
