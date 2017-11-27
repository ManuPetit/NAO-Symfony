<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 19/11/2017
 * Time: 06:49
 */

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $labelClass = 'col-12 col-md-4 col-form-label';
        $inputClass = 'form-control';
        $builder
            ->add('email', EmailType::class,[
                'label' => 'E-mail',
                'required' => false,
                'label_attr' => [
                    'class' => $labelClass
                ],
                'attr' => [
                    'class' => $inputClass
                ]
            ])
            ->add('plainPassword', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => false,
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                    'label_attr' => [
                        'class' => $labelClass
                    ],
                    'attr' => [
                        'class' => $inputClass
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer mot de passe',
                    'label_attr' => [
                        'class' => $labelClass
                    ],
                    'attr' => [
                        'class' => $inputClass
                    ]
                ]
            ])
            ->add('town', TextType::class, [
                'label' => 'Ville',
                'required' => false,
                'label_attr' => [
                    'class' => $labelClass
                ],
                'attr' => [
                    'class' => $inputClass
                ]
            ])
            ->add('phone', TextType::class,[
                'label' => 'Téléphone',
                'required' => false,
                'label_attr' => [
                    'class' => $labelClass
                ],
                'attr' => [
                    'class' => $inputClass
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'UserBundle\Entity\User',
            'attr' => ['id' => 'profil_form']
        ]);
    }
}