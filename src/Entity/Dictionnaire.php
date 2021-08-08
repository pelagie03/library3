<?php

namespace App\Entity;

use App\Repository\DictionnaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DictionnaireRepository::class)
 */
class Dictionnaire extends Volume
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $anneeEdition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeEdition(): ?\DateTimeInterface
    {
        return $this->anneeEdition;
    }

    public function setAnneeEdition(\DateTimeInterface $anneeEdition): self
    {
        $this->anneeEdition = $anneeEdition;

        return $this;
    }
}
