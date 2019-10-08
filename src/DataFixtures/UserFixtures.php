<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Theme;
use App\Entity\User;
//use App\Entity\Word;
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

        $user->setPassword($this->passwordEncoder->encodePassword($user, 'lolilol54'));

                 for ($i = 0; $i < 5; $i++) {
                    $user = new User();
                    $user->setEmail($faker->email());
                    $user->setPassword($faker->password());
                    $user->setPseudo($faker->name());
                    $user->setBirthdate($faker->date());

                    for ($j = 0; $j < 3; $j++) {
                        $theme = new Theme();
                        $theme->setDescription($faker->paragraph());
                        $theme->setUserId($user);
                        $manager->persist($theme);

                        for ($k = 0; $k < 10; $k++) {
                            $word = new Word();
                            $word->setLangFrom($faker->languageCode());
                            $word->setLangTo($faker->languageCode());
                            $word->setThemeId($theme);
                            $manager->persist($word);
                        }
                    }
                    $manager->persist($user);
                }
            $manager->flush();
    }
}
