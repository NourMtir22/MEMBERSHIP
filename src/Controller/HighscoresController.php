<?php

namespace App\Controller;

use App\Entity\Highscores;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/highscores')]
class HighscoresController extends AbstractController
{
    #[Route('/', name: 'app_highscores_indexClient', methods: ['GET'])]
    public function indexClient(EntityManagerInterface $entityManager, Request $request): Response
    {
        $order = $request->query->get('order', 'desc'); // Default sorting order is descending

        $highscores = $entityManager
            ->getRepository(Highscores::class)
            ->findBy([], ['score' => $order]);

        return $this->render('highscores/index.html.twig', [
            'highscores' => $highscores,
            'order' => $order,
        ]);
    }

    #[Route('/{idS}', name: 'app_highscores_show', methods: ['GET'])]
    public function show(Highscores $highscore): Response
    {
        return $this->render('highscores/show.html.twig', [
            'highscore' => $highscore,
        ]);
    }
}
