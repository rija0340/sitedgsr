<?php

namespace App\DataFixtures;

use App\Entity\DG;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DGFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

         $faker = \Faker\Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++){

        	$director = new DG();

        	 $director->setName($faker->name())
                      ->setGrade($faker->text(10))
                      ->setFilename($faker->text(10))
                      ->setPeriode($faker->numberBetween(1999, 2019))
               ;
            $manager->persist($director);
        }

        $manager->flush();
    }
}
