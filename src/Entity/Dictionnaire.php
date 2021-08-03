<?php

namespace App\Entity;

use App\Repository\DictionnaireRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private $annee_edition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeEdition(): ?\DateTimeInterface
    {
        return $this->annee_edition;
    }

    public function setAnneeEdition(\DateTimeInterface $annee_edition): self
    {
        $this->annee_edition = $annee_edition;

        return $this;
    }
}
