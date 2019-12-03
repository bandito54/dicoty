<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Word;
use App\Entity\Translation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, EntityManagerInterface $manager)
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


        $word = new Word();
        $wordform = $this->createFormBuilder($word)
                ->add('text', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Enter Word to translate',
                        'class' => 'form-control '
                    ]
                ])
                ->getForm();

        $translat = new Translation();
        $translatform = $this->createFormBuilder($translat)
                ->add('Tr_text', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Enter Translation',
                        'class' => 'form-control input-sm-2'
                    ]
                ])
                ->getForm();


        return $this->render('home/main.html.twig', [
            'controller_name' => 'HomeController',
            'formWord' => $wordform->createView(),
            'formTranslat' => $translatform->createView(),
            'themes' => $themes,

        ]);
    }

    /**
     * @Route("/", name="root")
     */
    public function root()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
