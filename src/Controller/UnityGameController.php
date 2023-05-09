<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnityGameController extends AbstractController
{
    #[Route('/unity-game', name: 'unity_game')]
    public function index(): Response
    {$entityManager = $this->getDoctrine()->getManager();
$queryBuilder = $entityManager->createQueryBuilder();
$queryBuilder->select('h')
    ->from('App\Entity\Highscores', 'h')
    ->orderBy('h.ids', 'DESC')
    ->setMaxResults(1);
$lastHighscore = $queryBuilder->getQuery()->getOneOrNullResult();

if ($lastHighscore !== null) {
    $lastHighscore->setScore(1000);
    $entityManager->flush();
}

        return $this->render('unity_game/index.html.twig');
    }
}
