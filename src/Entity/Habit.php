<?php

namespace App\Entity;

use App\Repository\HabitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HabitRepository::class)
 */
class Habit
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=HabitTracker::class, mappedBy="habits")
     */
    private $habitTrackers;



    public function __construct()
    {
        $this->habitTrackers = new ArrayCollection();
    }

//    /**
//     * @ORM\ManyToOne(targetEntity=User::class)
//     * @ORM\JoinColumn(nullable=false)
//     */
////    private $owner;

//    /**
//     * @ORM\Column(type="boolean")
//     */
//    private $competed;

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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

//    public function getOwner(): ?User
//    {
//        return $this->owner;
//    }
//
//    public function setOwner(?User $owner): self
//    {
//        $this->owner = $owner;
//
//        return $this;
//    }

//    public function getCompeted(): ?bool
//    {
//        return $this->competed;
//    }
//
//    public function setCompeted(bool $competed): self
//    {
//        $this->competed = $competed;
//
//        return $this;
//    }

/**
 * @return Collection<int, HabitTracker>
 */
public function getHabitTrackers(): Collection
{
    return $this->habitTrackers;
}

public function addHabitTracker(HabitTracker $habitTracker): self
{
    if (!$this->habitTrackers->contains($habitTracker)) {
        $this->habitTrackers[] = $habitTracker;
        $habitTracker->addHabit($this);
    }

    return $this;
}

public function removeHabitTracker(HabitTracker $habitTracker): self
{
    if ($this->habitTrackers->removeElement($habitTracker)) {
        $habitTracker->removeHabit($this);
    }

    return $this;
}

}
