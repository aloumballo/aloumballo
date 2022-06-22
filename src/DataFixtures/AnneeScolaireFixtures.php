<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnneeScolaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 2019; $i < 2022; $i++) {
            $annee = new AnneeScolaire();
            $indice = $i . "-" . $i + 1;
            $annee->setLibelleAnnee($indice);
            $manager->persist($annee);
        }




        $manager->flush();
    }
}