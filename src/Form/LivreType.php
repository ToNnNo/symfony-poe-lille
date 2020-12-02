<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer le titre du livre',
                    'autocomplete' => 'off'
                ],
                'help' => "Renseigner le titre principale de l'oeuvre",
                'help_attr' => [
                    'class' => "small form-text text-muted"
                ]
            ])
            ->add('resume', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer le résumé'
                ]
            ])
            ->add('parution', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Choisissez la date de parution'
                ]
            ])

            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisissez le genre du livre',
                'attr' => [
                    'class' => 'custom-select'
                ]
            ])

            ->add('auteurs', EntityType::class, [
                'class' => Auteur::class,
                'choice_label' => function(Auteur $auteur) {
                    return $auteur->getPrenom()." ".$auteur->getNom();
                },
                'expanded' => true,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
            'required' => false
        ]);
    }
}
