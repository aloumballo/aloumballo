<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Inscrire;
use App\Form\EtudiantType;
use App\Repository\AnneeScolaireRepository;
use App\Repository\EtudiantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ContainerFymvLie\PaginatorInterface_82dac15;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(
        EtudiantRepository $repo,
        PaginatorInterface $paginator,
        Request $request

    ): Response {
        $data = $repo->findAll();
        $mba = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            2
        );
        // $mba = $repo->findAll();
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'mba' => $mba,
        ]);
    }





    /* *************************Inscription de l'etudiant****************** */
    #[Route('/addEtu', name: 'app_addEtu')]
    public function inscrire(Request $request, UserPasswordHasherInterface $hassPassword, EntityManagerInterface $manager, AnneeScolaireRepository $anneerepo): Response
    {

        $etudiant = new Etudiant();
        $annee = $anneerepo->findOneById(9);
        $etat = 0;

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant->setRoles(["ROLE_ETUDIANT"]);
            $etudiant->setMatricule("Mballo-" . date('dmYHis'));
            /* hacher le mot de passre*/
            $motDePasse = "passer";

            $etudiant->setPassword($hassPassword->hashPassword($etudiant, $motDePasse));
            $manager->persist($etudiant);
            $ins = new Inscrire();
            $ins->setEtudiant($etudiant);
            $ins->setEtatInscription($etat);
            $ins->setAnnescolaire($annee);
            $ins->setClasse($form->get('classe')->getData());


            $manager->persist($ins);
            $manager->flush();

            // dd($etudiant);
        }

        return $this->render('etudiant/index.html.twig', [
            'form' => $form->createView()

        ]);
    }
}