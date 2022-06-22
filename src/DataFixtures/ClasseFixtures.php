<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $filieres = ['Dev Web', 'Dev Mobile', 'Dev Web Mobile', 'Ref Dig'];
        $niveau = ['L1', 'L2', 'L3', 'M1'];
        for ($i = 0; $i < 10; $i++) {
            $classe = new Classe;
            $rand = rand(0, 3);
            $classe->setFiliere($filieres[$rand])
                ->setNiveau($niveau[$rand])
                ->setLibelle('Classe' . $i);
            $manager->persist($classe);
        }

        $manager->flush();
    }
}