<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleFr', TextType::class, [
                'label'=> "Titre Français",
                'attr' => [
                    'placeholder' => "Saisir le titre en français"
                ]
            ])
            ->add('titleEn', TextType::class, [
                'label'=> "Titre Anglais",
                'attr' => [
                    'placeholder' => "Saisir le titre en anglais"
                ]
            ])
            ->add('number', NumberType::class, [
                'label'=> "Nomre de chambre",
                'attr' => [
                    'placeholder' => "Saisir le nombre de chambre"
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => "Prix (F CFA)",
                'attr' => [
                    'placeholder'=> "Saisir le prix en F CFA",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
