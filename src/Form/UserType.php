<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, [
                'label' => "Login",
                'attr' => [
                    'placeholder' => "Saisir votre nom d'utilisateur",
                ]
            ])
            ->add('hash', PasswordType::class, [
                'label' => "Mot de passe",
                'attr' => [
                    'placeholder' => "Saisir mot de passe",
                ]
            ])
            ->add('passwordConfirm', PasswordType::class, [
                'label' => "Confirmation mot de passe",
                'attr' => [
                    'placeholder' => "Confirmer votre mot de passe",
                ]
            ])
            ->add('userRoles', EntityType::class, [
                'label' => "Niveau d'accès",
                'class' => Role::class,
                'choice_label' => 'title',
                'multiple' => true,
                'attr' => [
                    'class' => 'select2 mb-3 select2-multiple w-100',
                    'placeholder' => "Choisir le niveau d'accès ...",
                ]

            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
