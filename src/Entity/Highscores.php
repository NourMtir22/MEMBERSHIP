<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "highscores")]
#[ORM\Entity]
class Highscores
{
    #[ORM\Column(name: 'idS', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $ids;

    #[ORM\Column(name: 'score', type: 'integer', nullable: true)]
    private ?int $score;
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

    
    public function setIds(?int $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

}
