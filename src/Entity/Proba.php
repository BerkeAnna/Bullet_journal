<?php

namespace App\Entity;

use App\Repository\ProbaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProbaRepository::class)
 */
class Proba
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lehetnull;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nemlehetnull;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLehetnull(): ?string
    {
        return $this->lehetnull;
    }

    public function setLehetnull(?string $lehetnull): self
    {
        $this->lehetnull = $lehetnull;

        return $this;
    }

    public function getNemlehetnull(): ?string
    {
        return $this->nemlehetnull;
    }

    public function setNemlehetnull(string $nemlehetnull): self
    {
        $this->nemlehetnull = $nemlehetnull;

        return $this;
    }
}
