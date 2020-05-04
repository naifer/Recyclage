<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="nomprod")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nomprod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adrlivraison;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modepaiment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomprod(): ?product
    {
        return $this->nomprod;
    }

    public function setNomprod(?product $nomprod): self
    {
        $this->nomprod = $nomprod;

        return $this;
    }

    public function getAdrlivraison(): ?string
    {
        return $this->adrlivraison;
    }

    public function setAdrlivraison(string $adrlivraison): self
    {
        $this->adrlivraison = $adrlivraison;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getModepaiment(): ?string
    {
        return $this->modepaiment;
    }

    public function setModepaiment(string $modepaiment): self
    {
        $this->modepaiment = $modepaiment;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

}
