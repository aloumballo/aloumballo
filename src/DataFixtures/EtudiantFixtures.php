<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nomComplet = ['Mor Liens', 'sindakh', 'weukheugn', 'Koulibaly pouff', 'Khourou Mouss'];
        $adresse = ['Guediawaye', 'Pikine', 'Fass', 'Nord Foire', 'zac mbao'];


        for ($i = 0; $i < 10; $i++) {
            $etu = new Etudiant();
            $rand = rand(0, 3);
            $etu->setNomComplet($nomComplet[$rand]);
            $etu->setAdresse($adresse[$rand]);
            $etu->setMatricule("mat" . date('dmYhis'));
            $etu->setSexe("sexe" . $i);

            $etu->setEmail("alou" . $i);
            $etu->setPassword('test');
            $manager->persist($etu);
        }
        $manager->flush();
    }
}