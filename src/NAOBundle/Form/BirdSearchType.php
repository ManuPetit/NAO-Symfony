<?php

namespace NAOBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirdSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('cdNom')
            ->remove('title')
            ->remove('place')
            ->remove('date')
            ->remove('latitude')
            ->remove('longitude')
            ->remove('content')
            ->remove('photos')
            ->remove('save')
            ->remove('saveAndAdd')
            ->add('Rechercher', SubmitType::class);
    }

    public function getParent()
    {
        return ObservationType::class;
    }
}
