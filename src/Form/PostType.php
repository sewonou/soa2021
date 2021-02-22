<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
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
            ->add('descriptionFr', TextareaType::class, [
                'label' => "Description en français",
                'attr' => [
                    'placeholder' => "Saisir la description du contenu en français",
                ]
            ])
            ->add('descriptionEn', TextareaType::class, [
                'label' => "Description en anglais",
                'attr' => [
                    'placeholder' => "Saisir la description du contenu en anglais",
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => "Catégorie",
                'class' => Category::class,
                'choice_label' => 'titleFr',
            ])

            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
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
            'data_class' => Post::class,
        ]);
    }
}
