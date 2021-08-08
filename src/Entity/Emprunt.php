<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="livreEmprunt")
     */
    private $adherent;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity=Livres::class, inversedBy="emprunts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pret;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="date")
     */
    private $dateEmp;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="date")
     */
    private $dateRet;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateEmp(): ?\DateTimeInterface
    {
        return $this->dateEmp;
    }

    public function setDateEmp(\DateTimeInterface $dateEmp): self
    {
        $this->dateEmp = $dateEmp;

        return $this;
    }

    public function getDateRet(): ?\DateTimeInterface
    {
        return $this->dateRet;
    }

    public function setDateRet(\DateTimeInterface $dateRet): self
    {
        $this->dateRet = $dateRet;

        return $this;
    }
}
