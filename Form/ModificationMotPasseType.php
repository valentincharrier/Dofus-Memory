<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModificationMotPasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newPassword', PasswordType::class, [
                   'label' => false,
                   'required' => true,
                   'attr' => [
                       'class' => 'btn btn-vert-pale form',
                       'id' => 'inputLogin',
                       'placeholder' => 'Nouveau mot de passe',
                       'title' => 'Renseignez le nouveau mot de passe',
                    ]
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'btn btn-vert-pale form',
                    'id' => 'inputLogin',
                    'placeholder' => 'Confirmation mot de passe',
                    'title' => 'Confirmez le nouveau mot de passe',
                ]
            ])
            ->add('token', TextType::class, [
                'label' => false,
            ])
            ->add('Modifier', SubmitType::class, [
                'label' => 'Modifier mon mot de passe',
                'attr' => [
                    'class' => 'btn btn-vert-pale form',
                    'title' => 'Modifier le nouveau mot de passe'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
