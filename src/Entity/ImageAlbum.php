<?php

namespace App\Entity;

use App\Repository\ImageAlbumRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageAlbumRepository::class)
 * * @ORM\Table(name="imageAlbums")
 */
class ImageAlbum
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="imageAlbums")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id", onDelete="SET NULL")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=DailyNote::class, inversedBy="imageAlbums")
     * @ORM\JoinColumn(name="dailyNote", referencedColumnName="id", onDelete="SET NULL")
     */
    private $dailyNote;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }


    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getDailyNote(): ?DailyNote
    {
        return $this->dailyNote;
    }

    public function setDailyNote(?DailyNote $dailyNote): self
    {
        $this->dailyNote = $dailyNote;

        return $this;
    }
}
