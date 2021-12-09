<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
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
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToOne(targetEntity=Payement::class, cascade={"persist", "remove"})
     */
    private $Payement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeCom;

    

    

   

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPayement(): ?Payement
    {
        return $this->Payement;
    }

    public function setPayement(?Payement $Payement): self
    {
        $this->Payement = $Payement;

        return $this;
    }

    public function getCodeCom(): ?string
    {
        return $this->codeCom;
    }

    public function setCodeCom(string $codeCom): self
    {
        $this->codeCom = $codeCom;

        return $this;
    }

    
    public function __toString()
    {
        return $this->codeCom;
    }

   
}
