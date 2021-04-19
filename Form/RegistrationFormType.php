<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom de joueur Dofus',
                    'class' => 'form-registration-input'
                ]
            ])
            ->add('serveur', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Eratz' => 'Eratz',
                    'Galgarion' => 'Galgarion',
                    'Henual' => 'Henual',
                    'Crail' => 'Crail',
                    'Monocompte VII' => 'Monocompte VII',
                    'Monocompte IX' => 'Monocompte IX',
                    'Monocompte X' => 'Monocompte X',
                ],
                'label' => false,
                'attr' => [
                    'class' => 'form-registration-input'
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'class' => 'form-registration-input',
                    'placeholder' => 'Renseignez votre email'
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'label' => false,
                'invalid_message' => 'Mots de passe différents',
                'required' => true,
                'options' => [
                    'attr' => [
                        'class' => 'btn btn-vert-pale form',
                        'id' => 'inputLogin',
                    ]
                ],
                'first_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Renseignez votre mot de passe']
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Confirmez votre mot de passe']
                ],
            ])
            ->add('sinscrire', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-vert-pale',
                    'id' => 'inscription',
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
