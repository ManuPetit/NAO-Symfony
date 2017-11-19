<?php

namespace NAOBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirdType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cdNom')
            ->add('latinName')
            ->add('frenchName',               EntityType::class, array(
            'label'         =>'Nom de l\'oiseau *',
            'class'         => 'NAOBundle:Bird',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('b')
                    ->orderBy('b.frenchName', 'ASC');
            },
            'choice_label'  => 'frenchName',
            'multiple'      => false
            ))
            ->add('author')
            ->add('description')
            ->add('family',               EntityType::class, array(
                'label'         =>'Famille *',
                'class'         => 'NAOBundle:Family',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->orderBy('f.name', 'ASC');
                },
                'choice_label'  => 'name',
                'multiple'      => false
            ))
            ->add('habitat');

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NAOBundle\Entity\Bird'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'naobundle_bird';
    }


}
