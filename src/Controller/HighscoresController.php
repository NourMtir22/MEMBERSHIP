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
    #[Route('/', name: 'app_highscores_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $highscores = $entityManager
            ->getRepository(Highscores::class)
            ->findAll();

        return $this->render('highscores/index.html.twig', [
            'highscores' => $highscores,
        ]);
    }

    #[Route('/new', name: 'app_highscores_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $highscore = new Highscores();
        $form = $this->createForm(HighscoresType::class, $highscore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($highscore);
            $entityManager->flush();

            return $this->redirectToRoute('app_highscores_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('highscores/new.html.twig', [
            'highscore' => $highscore,
            'form' => $form,
        ]);
    }

    #[Route('/{ids}', name: 'app_highscores_show', methods: ['GET'])]
    public function show(Highscores $highscore): Response
    {
        return $this->render('highscores/show.html.twig', [
            'highscore' => $highscore,
        ]);
    }

    #[Route('/{ids}/edit', name: 'app_highscores_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Highscores $highscore, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HighscoresType::class, $highscore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_highscores_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('highscores/edit.html.twig', [
            'highscore' => $highscore,
            'form' => $form,
        ]);
    }

    #[Route('/{ids}', name: 'app_highscores_delete', methods: ['POST'])]
    public function delete(Request $request, Highscores $highscore, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$highscore->getIds(), $request->request->get('_token'))) {
            $entityManager->remove($highscore);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_highscores_index', [], Response::HTTP_SEE_OTHER);
    }
}
