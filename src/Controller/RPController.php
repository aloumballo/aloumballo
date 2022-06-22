<?php

namespace App\Controller;

use App\Entity\RP;
use App\Form\RpType;
use App\Repository\RPRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RPController extends AbstractController
{
    #[Route('/r/p', name: 'app_r_p')]
    public function index(RPRepository $repo): Response
    {
        $rps = $repo->findAll();
        return $this->render('rp/index.html.twig', [
            'controller_name' => 'RPController',
            'rps' => $rps
        ]);
    }
    #[Route('/all/rp', name: 'all_rp')]
    public function all(Request $request)
    {
        $rp = new RP();
        $form = $this->createForm(RpType::class, $rp);
        return $this->render('rp/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}