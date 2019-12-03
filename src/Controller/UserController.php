<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Word;
use App\Entity\Theme;
use App\Entity\Translation;
use App\Entity\Lang;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;



class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/main", name="main")
     */
    public function main()
    {

        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $themes = $this->getDoctrine()->getRepository(User::class)->find($id)->getThemes();

        foreach ($themes as $theme) {
            $idt = $theme->getId();
            $description = $theme->getDescription();
            $words = $theme->getWords();
            foreach ($words as $word)
            {
                $text = $word->getText();
                $translation = $word->getTranslation();

                foreach ($translation as $tr)
                {
                    $textTranslated = $tr->getText();
                }
            }
        }

        return $this->render('home/main.html.twig', [
            'controller_name' => 'UserController',
            'themes' => $themes,
        ]);
    }
}
