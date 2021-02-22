<?php

namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAt', DateType::class, [
                'widget' => 'single_text',
                'label' => "Date des activités",
                /*'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker',
                ]*/

            ])
            ->add('titleFr', TextType::class, [
                'label' => "Description en Français",
                'attr' => [
                    'placeholder'=> "Saisir la titre français",
                ]
            ])
            ->add('titleEn', TextType::class, [
                'label' => "Description en anglais",
                'attr' => [
                    'placeholder'=> "Saisir la titre anglais",
                ]
            ])
            ->add('events', CollectionType::class, [
                'entry_type' => EventType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'=> true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
