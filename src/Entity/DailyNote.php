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
     * @ORM\Column(type="datetime", nullable=true)
     */

    private $image;

    /**
     * @ORM\OneToOne(targetEntity=MoodTracker::class)
     * @ORM\JoinColumn(name="moodTracker", referencedColumnName="id", onDelete="SET NULL")
     */
    private $mood;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="dailyNotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity=DailyHelper::class, mappedBy="owner")
     * @ORM\JoinColumn(name="dailyHelpers_user")
     */
    private $dailyHelpers;

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

    /**
     * @return Collection<int, DailyHelper>
     */
    public function getDailyHelpers(): Collection
    {
        return $this->dailyHelpers;
    }

    public function addDailyHelper(DailyHelper $dailyHelper): self
    {
        if (!$this->dailyHelpers->contains($dailyHelper)) {
            $this->dailyHelpers[] = $dailyHelper;
            $dailyHelper->addOwner($this);
        }

        return $this;
    }

    public function removeDailyHelper(DailyHelper $dailyHelper): self
    {
        if ($this->dailyHelpers->removeElement($dailyHelper)) {
            $dailyHelper->removeOwner($this);
        }

        return $this;
    }
}
