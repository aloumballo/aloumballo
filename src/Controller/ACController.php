<?php

namespace App\Controller;

use App\Entity\AC;
use App\Form\AcType;
use App\Repository\ACRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ACController extends AbstractController
{
    #[Route('/a/c', name: 'app_a_c')]

    public function index(ACRepository $repo): Response
    {
        $acs = $repo->findAll();
        return $this->render('ac/index.html.twig', [
            'controller_name' => 'ACController',
            'acs' => $acs
        ]);
    }

    #[Route('/add/ac', name: 'add_ac')]

    public function add(Request $request, ACRepository $repo)
    {
        $ac = new AC();
        $form = $this->createForm(AcType::class, $ac);

        //dd($ac);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ac = $form->getData();
            $repo->add($ac, true);
            return $this->redirectToRoute('app_a_c');
        }
        return $this->render('ac/form.html.twig', [
            'form' => $form->createView()

        ]);
    }
}