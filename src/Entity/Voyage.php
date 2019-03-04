<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * voyage
 *
 * @ORM\Entity(repositoryClass="App\Repository\VoyageRepository")
 */
class Voyage
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
     *
     * @ORM\Column(name="villeDepart", type="string", length=50, nullable=false)
     */
    private $villedepart;

    /**
     * @var string
     *
     * @ORM\Column(name="villeArrive", type="string", length=50, nullable=false)
     */
    private $villearrive;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default"="1"})
     */
    private $status = '1';


    /**
     * @ORM\Column(type="datetime")
     */
    private $debut_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="voyage")
     */
    private $idVehicule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailsVoyage", mappedBy="Voyage")
     */
    private $detailvoyages;

    public function __construct()
    {
        $this->detailvoyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilledepart(): ?string
    {
        return $this->villedepart;
    }

    public function setVilledepart(string $villedepart): self
    {
        $this->villedepart = $villedepart;

        return $this;
    }

    public function getVillearrive(): ?string
    {
        return $this->villearrive;
    }

    public function setVillearrive(string $villearrive): self
    {
        $this->villearrive = $villearrive;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }



    public function getDebutAt(): ?\DateTimeInterface
    {
        return $this->debut_at;
    }

    public function setDebutAt(\DateTimeInterface $debut_at): self
    {
        $this->debut_at = $debut_at;

        return $this;
    }

    public function getIdVehicule(): ?Vehicule
    {
        return $this->idVehicule;
    }

    public function setIdVehicule(?Vehicule $idVehicule): self
    {
        $this->idVehicule = $idVehicule;

        return $this;
    }

    /**
     * @return Collection|DetailsVoyage[]
     */
    public function getDetailvoyages(): Collection
    {
        return $this->detailvoyages;
    }

    public function addDetailvoyage(DetailsVoyage $detailvoyage): self
    {
        if (!$this->detailvoyages->contains($detailvoyage)) {
            $this->detailvoyages[] = $detailvoyage;
            $detailvoyage->setVoyage($this);
        }

        return $this;
    }

    public function removeDetailvoyage(DetailsVoyage $detailvoyage): self
    {
        if ($this->detailvoyages->contains($detailvoyage)) {
            $this->detailvoyages->removeElement($detailvoyage);
            // set the owning side to null (unless already changed)
            if ($detailvoyage->getVoyage() === $this) {
                $detailvoyage->setVoyage(null);
            }
        }

        return $this;
    }
}
