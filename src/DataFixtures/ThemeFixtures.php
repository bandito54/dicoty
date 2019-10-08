<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
    /*    $faker = \Faker\Factory::create('fr_FR');

        // $Theme = new Theme();
        // $manager->persist($Theme);
        for ($i = 0; $i < 5; $i++) {
            $theme = new Theme();
            $theme->setDescription($faker->word());
            $theme->setUserId($usr);
            $manager->persist($theme);
        }
*/
        $manager->flush();
    }
}
