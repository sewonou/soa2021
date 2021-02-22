<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
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
            ->add('subMenus', CollectionType::class, [
                'entry_type' => SubMenuType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
