<?php

namespace App\Form;

use App\Entity\Theme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ThemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Description');
            // ->add('Picture')
            // ->add('UserId')
            // ->add(
            //     'words',
            //     CollectionType::class,
            //     [
            //         'entry_type' => WordType::class, // le formulaire enfant qui doit être répété
            //         'allow_add' => true, // true si tu veux que l'utilisateur puisse en ajouter
            //         'allow_delete' => true, // true si tu veux que l'utilisateur puisse en supprimer
            //         'label' => 'texte de trad',
            //         'by_reference' => false,])
            // ->add(
            //     'translations',
            //     CollectionType::class,
            //     [
            //         'entry_type' => TranslationType::class,
            //         'allow_add' => true,
            //         'allow_delete' => true,
            //         'label' => 'texte de trad',
            //         'by_reference' => false,]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Theme::class,
        ]);
    }
}
