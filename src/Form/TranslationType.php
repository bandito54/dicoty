<?php

namespace App\Form;

use App\Entity\Theme;
use App\Form\WordType;
use App\Form\ThemeType;
use App\Entity\Translation;
use Doctrine\ORM\EntityRepository;
use App\Repository\ThemeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TranslationType extends AbstractType
{
    private $repo;

    public function __construct(ThemeRepository $themerepository) {
        $this->repo = $themerepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('Tr_text', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Translation'
            ])

            ->add('word', WordType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Word to translate'
                ])

            ->add('theme', ThemeType::class, [
            'required' => false, 
            'attr' => ['class' => 'form-control'],
            'label' => 'Create a new theme ?', 
            ])

            ->add('ThemeId', EntityType::class, [
                'required' => false, 
                'label' => 'Pick a theme',
                'class' => Theme::class,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('t')
                        ->where('t.UserId = :uid')
                        ->setParameter('uid', $options['userid']);
                },
                'multiple' => false,
                'choice_label' => 'Description',
                'placeholder' => 'Pick it !',

                'attr' => ['class' => 'form-control']
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
