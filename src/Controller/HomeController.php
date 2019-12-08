<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Word;
use App\Entity\Theme;
use App\Form\UserType;
use App\Form\WordType;
use App\Form\ThemeType;
use App\Entity\Translation;
use App\Form\TranslationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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

        // $theme = new Theme();

        // $form = $this->createForm(ThemeType::class, $theme);

        $word = new Word();
        $translat = new Translation();
        $theme = new Theme();


            $form1 = $this->createFormBuilder($word)
            ->add('Text', TextType::class)
            ->getForm();

            $form2 = $this->createFormBuilder($translat)
            ->add('Tr_text', TextType::class)
            ->getForm();

            $form3 = $this->createFormBuilder($theme)
            ->add('Description', TextType::class)
            ->getForm();

            $request->getPathInfo();
        dump($request);

        if ($form1->isSubmitted() && $form1->isValid()) {
            
             $manager->persist($theme);
             $manager->persist($word);
             $manager->persist($translat);
            
             $manager->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('home/main.html.twig', [
            'controller_name' => 'HomeController',
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
            'form3' => $form3->createView(),
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
