<?php

namespace App\Form;

use App\Entity\Transportation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameFr', TextType::class, [
                'label' => "Nom français",
                'attr' => [
                    'placeholder'=> "Saisir le nom en français"
                ]
            ])
            ->add('nameEn', TextType::class, [
                'label' => "Nom anglais",
                'attr' => [
                    'placeholder'=> "Saisir le nom en anglais"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transportation::class,
        ]);
    }
}
