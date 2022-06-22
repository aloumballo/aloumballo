<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $repo): Response
    {
        $classes = $repo->findAll();
        // dd($classes);

        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes' => $classes
        ]);
    }
    #[Route('/add/classe', name: 'app_classe_add')]
    public function add(Request $request, ClasseRepository $repo)
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $classe = $form->getData();
            $repo->add($classe, true);
            return $this->redirectToRoute('app_classe');
        }
        return $this->render('classe/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /* supprimer*/
    #[Route('/classe/delete/{id}', name: 'delete-classe')]
    public function delete(Classe $class, ClasseRepository $repo)
    {
        $repo->remove($class, true);
        return new Response($this->redirectToRoute("app_classe"));
    }

    /* Modifier */

    #[Route('/classe/edit/{id}', name: 'edit-classe')]
    public function edit($id, ClasseRepository $repo, Request $request)
    {
        $classe = $repo->find($id);
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($form->getData(), true);
            return $this->redirectToRoute("app_classe");
        }
        return $this->render('classe/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}