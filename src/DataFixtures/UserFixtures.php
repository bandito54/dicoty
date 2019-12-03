<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Theme;
use App\Entity\User;
use App\Entity\Word;
use App\Entity\Lang;
use App\Entity\Translation;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
       $user = new User();
        $faker = \Faker\Factory::create('fr_FR');
        
        $lang0 = new Lang();
        $lang0->setName("Français");
        $manager->persist($lang0);

        $lang1 = new Lang();
        $lang1->setName("English");
        $manager->persist($lang1);

        $lang2 = new Lang();
        $lang2->setName("Italiano");
        $manager->persist($lang2);

        $lang3 = new Lang();
        $lang3->setName("Español");
        $manager->persist($lang3);

        $lang4 = new Lang();
        $lang4->setName("Deutsch");
        $manager->persist($lang4);
      //  $user->setPassword($this->passwordEncoder->encodePassword($user, ''));

                 for ($i = 0; $i < 5; $i++) {
                    $user = new User();
                    $user->setEmail($faker->email());
                    $user->setPassword($faker->password());
                    $user->setPseudo($faker->name());
                    $manager->persist($user);

                    for ($j = 0; $j < 3; $j++) {
                        $theme = new Theme();
                        $theme->setDescription($faker->paragraph());
                        $theme->setUserId($user);
                        $manager->persist($theme);

                        for ($k = 0; $k < 10; $k++) {
                            $word = new Word();
                            $tr = new Translation();

                            $word->setLangId($lang0);
                            $word->setThemeId($theme);
                            $word->setText($faker->realText($maxNbChars = 10, $indexSize = 2));
                            $manager->persist($word);

                            $tr->setLangId($lang1);
                            $tr->setThemeId($theme);
                            $tr->setWordId($word);
                            $tr->setText($faker->realText($maxNbChars = 10, $indexSize = 2));
                            $manager->persist($tr);
                        }
                    }

                }
            $manager->flush();
    }
}
