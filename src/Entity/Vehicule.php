<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vehicule
 *
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 * @UniqueEntity("matricule")
 */
class Vehicule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\Regex("/^([a-zA-Z]{2})([0-9]{4})([a-zA-Z]{2})$/")
     * @ORM\Column(name="matricule", type="string", length=70, nullable=false)
     */
    private $matricule;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    private $type;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tonnage", type="integer", nullable=true)
     */
    private $tonnage;

    /**
     * @Assert\Length(min="5", max="100")
     * @var int|null
     *
     * @ORM\Column(name="age_vehicule", type="integer", nullable=true)
     */
    private $ageVehicule;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Abonnement", mappedBy="id_vehicule")
     */
    private $abonnements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Abonnes",inversedBy="listeVehicule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAbonne;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voyage", mappedBy="idVehicule")
     */
    private $voyage;

    public function __construct()
    {
        $this->abonnements = new ArrayCollection();
        $this->voyage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTonnage(): ?int
    {
        return $this->tonnage;
    }

    public function setTonnage(?int $tonnage): self
    {
        $this->tonnage = $tonnage;

        return $this;
    }

    public function getAgeVehicule(): ?int
    {
        return $this->ageVehicule;
    }

    public function setAgeVehicule(?int $ageVehicule): self
    {
        $this->ageVehicule = $ageVehicule;

        return $this;
    }
    

    /**
     * @return Collection|Abonnement[]
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): self
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements[] = $abonnement;
            $abonnement->setIdVehicule($this);
        }

        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): self
    {
        if ($this->abonnements->contains($abonnement)) {
            $this->abonnements->removeElement($abonnement);
            // set the owning side to null (unless already changed)
            if ($abonnement->getIdVehicule() === $this) {
                $abonnement->setIdVehicule(null);
            }
        }

        return $this;
    }

    public function getIdAbonne(): ?Abonnes
    {
        return $this->idAbonne;
    }

    public function setIdAbonne(?Abonnes $idAbonne): self
    {
        $this->idAbonne = $idAbonne;

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyage(): Collection
    {
        return $this->voyage;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyage->contains($voyage)) {
            $this->voyage[] = $voyage;
            $voyage->setIdVehicule($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyage->contains($voyage)) {
            $this->voyage->removeElement($voyage);
            // set the owning side to null (unless already changed)
            if ($voyage->getIdVehicule() === $this) {
                $voyage->setIdVehicule(null);
            }
        }

        return $this;
    }
}
