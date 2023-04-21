<?php

namespace App\Controller;

use App\Entity\Highscores;
use App\Form\HighscoresType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/highscores')]
class HighscoresController extends AbstractController
{
    #[Route('/', name: 'app_highscores_indexClient', methods: ['GET'])]
    public function indexClient(EntityManagerInterface $entityManager): Response
    {
        $highscores = $entityManager
            ->getRepository(Highscores::class)
            ->findAll();

        return $this->render('indexClient.html.twig', [
            'highscores' => $highscores,
        ]);
    }

   

    #[Route( '/',name: 'app_highscores_show', methods: ['GET'])]
    public function show(Highscores $highscore): Response
    {
        return $this->render('highscores/show.html.twig', [
            'highscore' => $highscore,
        ]);
    }

    
}
