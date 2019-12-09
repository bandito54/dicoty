<?php

namespace App\Form;

use App\Entity\Theme;
use App\Form\WordType;
use App\Form\ThemeType;
use App\Entity\Translation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Repository\ThemeRepository;

class TranslationType extends AbstractType
{
    private $repo;

    public function __construct(ThemeRepository $themerepository) {
        $this->repo = $themerepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('Tr_text', TextType::class)
            ->add('word', WordType::class)
            ->add('theme', ThemeType::class)
            ->add('ThemeId', EntityType::class, [
                'class' => Theme::class,
                'multiple' => true,
                // 'choice_label' => 'Description',
                //'choices' => $this->repo->findThemeOfUser($options['userid'])

                'query_builder'     => function (ThemeRepository $er) use ( $options ) {
                 return $er->findThemeOfUser($options['userid']);
            }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Translation::class,
            'userid' => null
        ]);
    }
}
