<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
// Add the use statement for the Range constraint
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use App\Entity\Cartefidelite;


/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity
 * @Assert\Callback("validate")
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ida;

    /**
 * @var string|null
 *
 * @ORM\Column(name="type", type="string", length=50, nullable=true)
 * @Assert\Choice(choices={"Bronze", "Gold", "Platinum"}, message="Choose a valid type: Bronze, Gold, or Platinum.")
 * @Assert\NotBlank(message="Type cannot be empty.")
 */
private $type;


   /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     * @Assert\Range(
     *      min = 0,
     *      max = 1070,
     *      notInRangeMessage = "The prix must be between {{ min }} and {{ max }}.",
     * )
     * * @Assert\NotBlank(message="Prix cannot be empty.")
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAchat", type="date", nullable=false)
     * * @Assert\NotBlank(message="Dateachat cannot be empty.")
     */
    private $dateachat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateExpiration", type="date", nullable=false)
     * @Assert\GreaterThan("today", message="The expiration date must be after the current date.")
     */
    private $dateexpiration;

    // ...
   

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    public $idUser;

    /**
     * Validates the Abonnement entity.
     *
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        // Perform your custom validation logic here
        
        if ($this->dateachat > $this->dateexpiration) {
            $context->buildViolation('The dateachat must be before the dateexpiration')
                ->atPath('dateachat')
                ->addViolation();
        }
    }
/**
     * @ORM\OneToOne(targetEntity="Cartefidelite", mappedBy="abonnement", cascade={"persist", "remove"})
     */
    private $cartefidelite;

    // Add getter and setter methods for $cartefidelite
    public function getCartefidelite(): ?Cartefidelite
    {
        return $this->cartefidelite;
    }

    public function setCartefidelite(?Cartefidelite $cartefidelite): self
    {
        $this->cartefidelite = $cartefidelite;
        // Set the owning side of the relation if necessary
        if ($cartefidelite !== null && $cartefidelite->getAbonnement() !== $this) {
            $cartefidelite->setAbonnement($this);
        }
        return $this;
    }
    public function getIda(): ?int
    {
        return $this->ida;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function getDateachat(): ?\DateTime
    {
        return $this->dateachat;
    }

    public function getDateexpiration(): ?\DateTime
    {
        return $this->dateexpiration;
    }

    
    public function setIda(int $ida): self
    {
        $this->ida = $ida;
        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function setDateachat(\DateTime $dateachat): self
    {
        $this->dateachat = $dateachat;
        return $this;
    }

    public function setDateexpiration(\DateTime $dateexpiration): self
    {
        $this->dateexpiration = $dateexpiration;
        return $this;
    }

    

}
