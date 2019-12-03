<?php

namespace App\Form;

use App\Entity\Word;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Text')
            ->add('LangId')
            ->add('ThemeId')
            ->add('translation')
        ;

        $builder->add('word', Word::class);

        return $this->render('home/main.html.twig', [
            'form' => $builder->createView(),
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Word::class,
        ]);
    }
}
