<?php

namespace App\Entity;

use App\Repository\JournalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JournalRepository::class)
 */
class Journal extends Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_parution;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumParution(): ?int
    {
        return $this->num_parution;
    }

    public function setNumParution(int $num_parution): self
    {
        $this->num_parution = $num_parution;

        return $this;
    }
}
