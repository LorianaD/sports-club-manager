<?php

namespace App\Form;

use App\Entity\TrainingSession;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date')
            ->add('time')
            ->add('location')
            ->add('coach', EntityType::class, [
                'class' => User::class,
                'choice_label' => function($coach) {
                    return $coach->getFirstname() . ' ' . $coach->getLastname();
                },
                'multiple' => true,
                'placeholder' => 'Choisir le coach qui va y participer',
            ])
            ->add('description', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrainingSession::class,
        ]);
    }
}
