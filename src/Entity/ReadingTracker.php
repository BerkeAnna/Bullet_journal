<?php

namespace App\Entity;

use App\Repository\ReadingTrackerRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReadingTrackerRepository::class)
 * * @ORM\Table(name="readingTrackers")
 */
class ReadingTracker
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $readPages;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="readingTrackers")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id", onDelete="SET NULL")
     */
    private $owner;

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

    public function getReadPages(): ?int
    {
        return $this->readPages;
    }

    public function setReadPages(?int $readPages): self
    {
        $this->readPages = $readPages;

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
