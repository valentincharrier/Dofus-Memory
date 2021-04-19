<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact_email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Adresse email...',
                ]
            ])
            ->add('contact_submit', SubmitType::class, [
                'label' => 'Envoyer l\'email',
            ])
            ;
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([]);
//    }
}