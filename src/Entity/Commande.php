<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbcommmande;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecomd;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbcommmande(): ?int
    {
        return $this->nbcommmande;
    }

    public function setNbcommmande(int $nbcommmande): self
    {
        $this->nbcommmande = $nbcommmande;

        return $this;
    }

    public function getDatecomd(): ?\DateTimeInterface
    {
        return $this->datecomd;
    }

    public function setDatecomd(\DateTimeInterface $datecomd): self
    {
        $this->datecomd = $datecomd;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCommandes(): ?User
    {
        return $this->commandes;
    }

    public function setCommandes(?User $commandes): self
    {
        $this->commandes = $commandes;

        return $this;
    }
}
