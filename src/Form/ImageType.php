<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('captionFr', TextType::class, [
                'label'=>"Caption Français",
                'attr'=> [
                    'placeholder' => "Saisir le caption français"
                ]
            ])
            ->add('captionEn', TextType::class, [
                'label'=>"Caption Anglais",
                'attr'=> [
                    'placeholder' => "Saisir le caption anglais"
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
            'data_class' => Image::class,
        ]);
    }
}
