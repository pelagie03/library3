<?php

namespace App\Entity;

use App\Repository\BdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BdRepository::class)
 */
class Bd extends Volume
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dessinateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDessinateur(): ?string
    {
        return $this->dessinateur;
    }

    public function setDessinateur(string $dessinateur): self
    {
        $this->dessinateur = $dessinateur;

        return $this;
    }
}
