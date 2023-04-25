<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Highscores
 *
 * @ORM\Table(name="highscores")
 * @ORM\Entity
 */
class Highscores
{
    /**
     * @var int
     *
     * @ORM\Column(name="idS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ids;

    /**
     * @var int|null
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    private $score;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    public function getIds(): ?int
    {
        return $this->ids;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;
        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }
    public function setIds(?int $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

}
