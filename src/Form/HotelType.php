<?php

namespace App\Form;

use App\Entity\Hotel;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Dénmmination",
                'attr' => [
                    'placeholder'=> "Saisir la dénommination de l'hotel",
                ]
            ])
            ->add('descriptionFr', TextareaType::class, [
                'label' => "Description en Français",
                'attr' => [
                    'placeholder'=> "Saisir la dscription française",
                ]
            ])
            ->add('descriptionEn', TextareaType::class, [
                'label' => "Description en Anglais",
                'attr' => [
                    'placeholder'=> "Saisir la description en Anglais",
                ]
            ])
            ->add('number', IntegerType::class, [
                'label' => "Nombre de chambre",
                'attr' => [
                    'placeholder'=> "Saisir le nombre total de chambre",
                ]
            ])
            ->add('minPrice', MoneyType::class, [
                'label' => "Prix Minimum (F CFA)",
                'attr' => [
                    'placeholder'=> "Saisir le prix minimum en F CFA",
                ]
            ])
            ->add('maxPrice', MoneyType::class, [
                'label' => "Prix Maximum (F CFA)",
                'attr' => [
                    'placeholder'=> "Saisir le prix maximum en F CFA",
                ]
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'=> false
            ])

            ->add('rooms', CollectionType::class, [
                'entry_type' => RoomType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'=> false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
