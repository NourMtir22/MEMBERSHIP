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
    private $ida;


}
