<?php

namespace App\Form;

use App\Entity\Abonnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('type', ChoiceType::class, [
            'choices' => [
                'Bronze' => 'Bronze',
                'Gold' => 'Gold',
                'Platinum' => 'Platinum',
            ],
            'label' => 'Type',
            'required' => true,
            'placeholder' => 'Choose a type',
        ])
            ->add('prix')
            ->add('dateachat')
            ->add('dateexpiration')
            ->add('idUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
