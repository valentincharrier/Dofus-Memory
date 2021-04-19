<?php

namespace App\Form;

use App\Entity\Dofus;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DofusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('niveau', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'input-dofus-editeur w-75 mb-3',
                    'placeholder' => 'Niveau... (ex: 6)'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'input-dofus-editeur w-75 mb-3',
                    'placeholder' => 'Nom... (ex: Dofus Cawotte)'
                ]
            ])

            ->add('image', FileType::class, [
                'label' => 'Choisissez une image au format .png',
                'data_class' => null,
                'required' => true,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Erreur : charger l\'image de type PNG',
                    ])
                ],
                'attr' => [
                    'class' => 'input-dofus-editeur w-75 mb-3 mx-auto text-center',
                ]
            ])
            ->add('effet', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'input-dofus-editeur w-75 mb-3',
                    'placeholder' => 'Effets... (ex: +6 à +50 Sagesse)'
                ]
            ])
            ->add('obtention', CKEditorType::class ,[
                'label' => false,
                'attr' => [
                    'class' => 'textarea-dofus-editeur rounded w-75 mb-3',
                    'rows' => 3,
                    'placeholder' => 'Obtention du Dofus... (ex: Ce Dofus se drop sur le Dragon Cochon...)'
                ]])
            ->add('description', CKEditorType::class ,[
                'label' => false,
                'attr' => [
                    'class' => 'textarea-dofus-editeur rounded w-75',
                    'rows' => 6,
                    'placeholder' => 'Description du Dofus...'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dofus::class,
        ]);
    }
}
