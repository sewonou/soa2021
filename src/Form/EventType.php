<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleFr', TextType::class, [
                'label' => "Titre français",
                'attr' => [
                    'placeholder' => "Saisir le titre en français"
                ]
            ])
            ->add('titleEn', TextType::class, [
                'label' => "Titre anglais",
                'attr' => [
                    'placeholder' => "Saisir le titre en anglais"
                ]
            ])
            ->add('startAt', TimeType::class, [
                'widget' => 'single_text',
                'label' => "Heure de début",
                'attr' => [
                    'class' => 'js-datepicker',
                ]
            ])
            ->add('endAt', TimeType::class, [
                'widget' => 'single_text',
                'label' => "Heure de fin",
                'attr' => [
                    'class' => 'js-datepicker',
                ]

            ])
            ->add('descriptionFr', TextareaType::class, [
                'label' => "Description français",
                'attr' => [
                    'placeholder' => "Saisir le description en français"
                ]
            ])
            ->add('descriptionEn', TextareaType::class,[
                'label' => "Description anglais",
                'attr' => [
                    'placeholder' => "Saisir le description en anglais"
                ]
            ])
            ->add('author', TextType::class, [
                'label' => "Orateur",
                'attr' => [
                    'placeholder' => "Saisir le nom de l'orateur"
                ]
            ])
            ->add('venue', TextType::class, [
                'label' => "Emplacement",
                'attr' => [
                    'placeholder' => "Saisir le libellé de la salle"
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label'=>"Choisir l'image",
                'attr'=> [
                    'placeholder' => "Choisir le fichier image"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
