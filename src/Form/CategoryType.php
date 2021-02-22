<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleFr', TextType::class, [
                'label' => "Intitulé en français",
                'attr' => [
                    'placeholder' => "Saisir l'intitulé en français",
                ]
            ])
            ->add('titleEn', TextType::class, [
                'label' => "Intitulé en anglais",
                'attr' => [
                    'placeholder' => "Saisir l'intitulé en anglais",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
