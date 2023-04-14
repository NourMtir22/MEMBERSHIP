<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartefidelite
 *
 * @ORM\Table(name="cartefidelite", indexes={@ORM\Index(name="idA", columns={"idA"})})
 * @ORM\Entity
 */
class Cartefidelite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCf;

    /**
     * @var string
     *
     * @ORM\Column(name="pointMerci", type="string", length=255, nullable=false)
     */
    private $pointmerci;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateExpiration", type="date", nullable=false)
     */
    private $dateexpiration;


    /**
     * @var int|null
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @var \Abonnement
     *
     * @ORM\ManyToOne(targetEntity="Abonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idA", referencedColumnName="idA")
     * })
     */
    private $abonnement;

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        $this->abonnement = $abonnement;
        return $this;
    }
        
    public function getIdCf(): ?int
    {
        return $this->idCf;
    }

    public function getPointmerci(): ?string
    {
        return $this->pointmerci;
    }

    public function getDateexpiration(): ?\DateTime
    {
        return $this->dateexpiration;
    }
    public function getIdUser(): ?int
    {
        return $this->idUser;
    }
    public function setIdCf(int $idCf): self
    {
        $this->idcf = $idCf;
        return $this;
    }
    public function setPointmerci(string $pointmerci): self
    {
        $this->pointmerci = $pointmerci;
        return $this;
    }
    public function setDateexpiration(\DateTime $dateexpiration): self
    {
        $this->dateexpiration = $dateexpiration;
        return $this;
    }
    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }
}
