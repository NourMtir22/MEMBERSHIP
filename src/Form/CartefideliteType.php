<?php

namespace App\Form;

use App\Entity\Cartefidelite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartefideliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pointmerci')
            ->add('dateexpiration')
            ->add('idUser')
            ->add('ida')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cartefidelite::class,
        ]);
    }
}