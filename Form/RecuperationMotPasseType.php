<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecuperationMotPasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,  [
                'label' => false,
                'attr' => [
                    'class' => 'btn btn-vert-pale form',
                    'id' => 'inputLogin',
                    'placeholder' => 'Votre adresse email',
                    'title' => 'Renseignez votre adresse email',
                ]])
            ->add('Modifier', SubmitType::class, [
                'label' => 'Récupérer le mot de passe',
                'attr' => [
                    'class' => 'btn btn-vert-pale form',
                    'title' => 'Envoyer l\'email',
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
