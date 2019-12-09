<?php

namespace App\Controller;

use App\Entity\Lang;
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
                    $textTranslated = $tr->getTrText();
                }
            }
        }

    $trlt = New Translation();
    $form2 = $this->createForm(TranslationType::class, $trlt, ['userid'=>$user->getId()]);
    $form2->handleRequest($request);
    dump($form2->getData());




    if ($form2->isSubmitted() && $form2->isValid()) {
        $mot = $form2['word']->getData();
        $trad = $form2['Tr_text']->getData();
        $description = $form2['theme']->getData();

        $translation = new Translation();
        $description->setUserId($user);

         $translation->setTrText($trad);
         $translation->setThemeId($description);
         $translation->setWordId($mot);
         $mot->setThemeId($description);

        


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($description);
        $entityManager->persist($mot);
        $entityManager->persist($translation);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }


        return $this->render('home/main.html.twig', [
            'controller_name' => 'HomeController',
            'form2' => $form2->createView(),
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
