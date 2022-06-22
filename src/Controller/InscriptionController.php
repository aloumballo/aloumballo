<?php

namespace App\Controller;

use App\Entity\Inscrire;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }
    #[Route('/ajout', name: 'app_ajout')]
    public function ajouter(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $inscription = new Inscrire();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($inscription);
            $entityManagerInterface->flush();
            $this->redirectToRoute('login');
        }
        return $this->render("inscription/ajouter.html.twig", ['form' => $form->createView()]);
    }
}