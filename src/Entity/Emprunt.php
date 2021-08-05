<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpruntRepository::class)
 */
class Emprunt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="date")
     */
    private $date_emprunt;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="date")
     */
    private $date_retour;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="livreEmprunt")
     */
    private $adherent;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity=Livres::class, inversedBy="emprunts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pret;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->date_emprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $date_emprunt): self
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }

    public function setDateRetour(\DateTimeInterface $date_retour): self
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getPret(): ?Livres
    {
        return $this->pret;
    }

    public function setPret(?Livres $pret): self
    {
        $this->pret = $pret;

        return $this;
    }
}
