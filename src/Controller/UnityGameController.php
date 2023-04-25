<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnityGameController extends AbstractController
{
    #[Route('/unity-game', name: 'unity_game')]
    public function index(): Response
    {
        return $this->render('unity_game/index.html.twig');
    }
}
