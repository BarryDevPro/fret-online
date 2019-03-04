<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="abonnees_message", columns={"idAbonnees"})})
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
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
     * @ORM\Column(name="contenu", type="text", length=0, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime", nullable=false)
     */
    private $datepublication;

    /**
     * @var \Abonnes
     *
     * @ORM\ManyToOne(targetEntity="Abonnes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAbonnees", referencedColumnName="id")
     * })
     */
    private $idabonnees;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDatepublication(): ?\DateTimeInterface
    {
        return $this->datepublication;
    }

    public function setDatepublication(\DateTimeInterface $datepublication): self
    {
        $this->datepublication = $datepublication;

        return $this;
    }

    public function getIdabonnees(): ?Abonnes
    {
        return $this->idabonnees;
    }

    public function setIdabonnees(?Abonnes $idabonnees): self
    {
        $this->idabonnees = $idabonnees;

        return $this;
    }


}
