<?php

namespace App\Entity;

use App\Repository\JournalRepository;
use Symfony\Component\Validator\Constraints as Assert;
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
    private $numparution;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumparution(): ?int
    {
        return $this->numparution;
    }

    public function setNumparution(int $numparution): self
    {
        $this->numparution = $numparution;

        return $this;
    }
}
