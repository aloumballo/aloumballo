<?php

namespace App\DataFixtures;

use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $nomComplet = ['Alou Mballo', 'sindakh', 'weukheugn'];
        $grade = ['Ingenieur', 'Voleur', 'Chevalier'];
        for ($i = 0; $i < 10; $i++) {

            $prof = new Professeur();
            $rand = rand(0, 2);
            $prof->setNomComplet($nomComplet[$rand]);

            $prof->setGrade($grade[$rand]);
            $prof->setEmail("mballo" . $i);
            $prof->setPassword('test');
            $manager->persist($prof);
        }
        $manager->flush();
    }
}