<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $libelleModule = ['Dev Web', 'Dev Web Mobile', 'Ref Dig'];

        for ($i = 0; $i < 10; $i++) {
            $module = new Module;
            $rand = rand(0, 2);
            $module->setLibelle($libelleModule[$rand])

                ->setLibelle('Module' . $i);
            $manager->persist($module);
        }


        $manager->flush();
    }
}