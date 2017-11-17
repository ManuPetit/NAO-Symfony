<?php

namespace NAOBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bird',               EntityType::class, array(
                'label'         =>'Nom de l\'oiseau *',
                'class'         => 'NAOBundle:Bird',
                'choice_label'  => 'frenchName',
                'multiple'      => false
            ))
            //choisir une famille
            ->add('title',              TextType::class,array(
                'label'         =>'Donner un titre à mon observation *',
            ))
            ->add('place',              TextType::class,array(
                'label'         =>'Lieu *',
            ))
            ->add('date',               DateTimeType::class,array(
                'label'         => 'Date de l\'observation *',
                'required'      => false,
                'widget'        =>'single_text',
                'placeholder'   =>'jj/mm/aaaa',
                'format'        =>'dd/MM/yyyy'))

            ->add('latitude',           NumberType::class,array(
                'scale'         => 6,
            ))
            ->add('longitude',          NumberType::class,array(
                'scale'         => 6,
            ))
            ->add('content',            TextareaType::class,array(
                'label'         => 'Description de l\'observation'
            ))
            ->add('photos',              CollectionType::class,array(
                'entry_type'   => PhotoType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('Envoyer',            SubmitType::class)
            ->add('Sauvegarder',        SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NAOBundle\Entity\Observation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'naobundle_observation';
    }


}
