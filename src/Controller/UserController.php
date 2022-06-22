<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /* pour la connexion */
    #[Route('/inscription', name: 'app_inscription')]

    public function inscription()
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        return $this->render('user/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}