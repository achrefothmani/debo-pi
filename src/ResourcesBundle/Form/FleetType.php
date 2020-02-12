<?php

namespace ResourcesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FleetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('matriculation')->add('nature',ChoiceType::class,array(
            'choices'=>array(
                'Truck'=>'Truck',
                'MotorBike'=>'MotorBike',
                'Van'=>'Van',
            )
        ))->add('capacity')->add('category',ChoiceType::class,array(
            'choices'=>array(
                'Cold'=>'Cold',
                'Neutral'=>'Neutral',
                'Brittle'=>'Brittle',
            )
        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ResourcesBundle\Entity\Fleet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'resourcesbundle_fleet';
    }


}
