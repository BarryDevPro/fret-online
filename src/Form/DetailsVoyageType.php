<?php

namespace App\Form;

use App\Entity\DetailsVoyage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsVoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville')
            ->add('datedepart')
            ->add('charge')
            ->add('decharge')
            ->add('positionx')
            ->add('positiony')
            ->add('idvoyage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailsVoyage::class,
        ]);
    }
}
