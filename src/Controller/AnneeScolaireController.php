<?php

namespace App\Controller;

use App\Entity\AnneeScolaire;
use App\Form\AnneeScolaireType;
use App\Repository\AnneeScolaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnneeScolaireController extends AbstractController
{
    #[Route('/annee/scolaire', name: 'app_annee_scolaire')]
    public function index(AnneeScolaireRepository $repo): Response
    {
        $annees = $repo->findAll();
        return $this->render('annee_scolaire/index.html.twig', [
            'controller_name' => 'AnneeScolaireController',
            'annees' => $annees
        ]);
    }
    #[Route('/add/anneescolaire', name: 'app_annee_scolaire_add')]
    public function addannee(Request $request, AnneeScolaireRepository $repo)
    {
        $anneescolaire = new AnneeScolaire();
        $form = $this->createForm(AnneescolaireType::class, $anneescolaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $anneescolaire = $form->getData();
            $repo->add($anneescolaire, true);
            return $this->redirectToRoute('app_annee_scolaire');
        }
        return $this->render('annee_scolaire/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}