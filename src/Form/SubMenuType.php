<?php

namespace App\Form;

use App\Entity\SubMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameFr', TextType::class, [
                'label' => "Titre en français",
                'attr' => [
                    'placeholder' => "Saisir le titre en français",
                ]
            ])
            ->add('nameEn', TextType::class, [
                'label' => "Titre en anglais",
                'attr' => [
                    'placeholder' => "Saisir le titre en anglais",
                ]
            ])
            ->add('isActive', CheckboxType::class, [
                'label'    => 'Activer',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SubMenu::class,
        ]);
    }
}
