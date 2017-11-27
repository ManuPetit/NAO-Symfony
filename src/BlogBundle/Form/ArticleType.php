<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/11/2017
 * Time: 14:16
 */

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre *',
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 10
                ]
            ])
            ->add('blogImages', CollectionType::class, [
                'entry_type' => BlogImageType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => "Sauvegarder",
                'attr' => [
                    'class' => 'btn-success btn-block',
                    ' formnovalidate' => 'formnovalidate',
                    'title' => 'Cliquez ici pour enregistrer votre article comme brouillon'
                ]
            ])
            ->add('post', SubmitType::class, [
                'label' => "Publier",
                'attr' => [
                    'class' => 'btn-success btn-block',
                    ' formnovalidate' => 'formnovalidate',
                    'title' => 'Cliquez ici pour publier votre article sur le site'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'BlogBundle\Entity\Post'
        ]);
    }
}