<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailsVoyage
 * @ORM\Entity(repositoryClass="App\Repository\DetailsVoyageRepository")
 */
class DetailsVoyage
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
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="datetime", nullable=false)
     */
    private $datedepart;

    /**
     * @var int
     *
     * @ORM\Column(name="charge", type="integer", nullable=false)
     */
    private $charge = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="decharge", type="integer", nullable=false)
     */
    private $decharge = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="positionX", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $positionx;

    /**
     * @var string
     *
     * @ORM\Column(name="positionY", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $positiony;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voyage", inversedBy="detailvoyages")
     */
    private $Voyage;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDatedepart(): ?\DateTimeInterface
    {
        return $this->datedepart;
    }

    public function setDatedepart(\DateTimeInterface $datedepart): self
    {
        $this->datedepart = $datedepart;

        return $this;
    }

    public function getCharge(): ?int
    {
        return $this->charge;
    }

    public function setCharge(int $charge): self
    {
        $this->charge = $charge;

        return $this;
    }

    public function getDecharge(): ?int
    {
        return $this->decharge;
    }

    public function setDecharge(int $decharge): self
    {
        $this->decharge = $decharge;

        return $this;
    }

    public function getPositionx()
    {
        return $this->positionx;
    }

    public function setPositionx($positionx): self
    {
        $this->positionx = $positionx;

        return $this;
    }

    public function getPositiony()
    {
        return $this->positiony;
    }

    public function setPositiony($positiony): self
    {
        $this->positiony = $positiony;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->Voyage;
    }

    public function setVoyage(?Voyage $Voyage): self
    {
        $this->Voyage = $Voyage;

        return $this;
    }


}
