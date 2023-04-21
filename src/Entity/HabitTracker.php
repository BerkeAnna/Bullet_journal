<?php

namespace App\Entity;

use App\Repository\HabitTrackerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HabitTrackerRepository::class)
 */
class HabitTracker
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
     * @ORM\OneToOne(targetEntity=Habit::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $habit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHabit(): ?Habit
    {
        return $this->habit;
    }

    public function setHabit(Habit $habit): self
    {
        $this->habit = $habit;

        return $this;
    }
}
