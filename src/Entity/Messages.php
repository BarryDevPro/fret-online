<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagesRepository")
 */
class Messages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $read_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Abonnes", inversedBy="ListeMessage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_Abonne;

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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getReadAt(): ?\DateTimeInterface
    {
        return $this->read_at;
    }

    public function setReadAt(\DateTimeInterface $read_at): self
    {
        $this->read_at = $read_at;

        return $this;
    }

    public function getIdAbonne(): ?Abonnes
    {
        return $this->id_Abonne;
    }

    public function setIdAbonne(?Abonnes $id_Abonne): self
    {
        $this->id_Abonne = $id_Abonne;

        return $this;
    }
}
