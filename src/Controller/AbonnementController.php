<?php

namespace App\Controller;

use App\Entity\Cartefidelite;

use App\Entity\Abonnement;
use App\Form\AbonnementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


#[Route('/abonnement')]
class AbonnementController extends AbstractController
{
    #[Route('/', name: 'app_abonnement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $abonnements = $entityManager
            ->getRepository(Abonnement::class)
            ->findAll();

        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnements,
        ]);
    }

    #[Route('/new', name: 'app_abonnement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $abonnement = new Abonnement();
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($abonnement);
    
            
            
    
            $entityManager->flush();
    
            $abonnement->setDateachat(new \DateTime());

            // Create a new Cartefidelite for the new Abonnement
            $cartefidelite = new Cartefidelite();
            $cartefidelite->setAbonnement($abonnement);
    
            // Set the required properties for Cartefidelite object
            $cartefidelite->setPointmerci("0"); // You can set a default value or calculate it based on your business logic
            $cartefidelite->setDateexpiration($abonnement->getDateexpiration());
          
    
            // Persist and flush the Cartefidelite object
            $entityManager->persist($cartefidelite);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('abonnement/new.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }
    


    #[Route('/{ida}', name: 'app_abonnement_show', methods: ['GET'])]
    public function show(Abonnement $abonnement): Response
    {
        return $this->render('abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }

    #[Route('/{ida}/edit', name: 'app_abonnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('abonnement/edit.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }

    #[Route('/{ida}', name: 'app_abonnement_delete', methods: ['POST'])]
public function delete(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('delete'.$abonnement->getIda(), $request->request->get('_token'))) {

        // Find the related Cartefidelite entity
        $carteFidelite = $entityManager->getRepository(Cartefidelite::class)->findOneBy(['abonnement' => $abonnement]);

        // If a Cartefidelite entity is found, remove it
        if ($carteFidelite) {
            $entityManager->remove($carteFidelite);
        }

        // Remove the Abonnement entity
        $entityManager->remove($abonnement);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
}

}
