<?php

namespace App\Entity;

use App\Repository\AdherentRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdherentRepository::class)
 */
class Adherent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */
    private $matricule;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @Assert\NotBlank
     * @ORM\OneToMany(targetEntity=Emprunt::class, mappedBy="adherent")
     */
    private $livreEmprunt;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="date")
     */
    private $datenaiss;

    public function __construct()
    {
        $this->livreEmprunt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatenaiss(): ?\DateTimeInterface
    {
        return $this->datenaiss;
    }

    public function setDatenaiss(\DateTimeInterface $datenaiss): self
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    /**
     * @return Collection|Emprunt[]
     */
    public function getLivreEmprunt(): Collection
    {
        return $this->livreEmprunt;
    }

    public function addLivreEmprunt(Emprunt $livreEmprunt): self
    {
        if (!$this->livreEmprunt->contains($livreEmprunt)) {
            $this->livreEmprunt[] = $livreEmprunt;
            $livreEmprunt->setAdherent($this);
        }

        return $this;
    }

    public function removeLivreEmprunt(Emprunt $livreEmprunt): self
    {
        if ($this->livreEmprunt->removeElement($livreEmprunt)) {
            // set the owning side to null (unless already changed)
            if ($livreEmprunt->getAdherent() === $this) {
                $livreEmprunt->setAdherent(null);
            }
        }

        return $this;
    }
}
