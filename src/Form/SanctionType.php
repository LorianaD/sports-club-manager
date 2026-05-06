<?php

namespace App\Form;

use App\Entity\Events;
use App\Entity\Player;
use App\Entity\Sanction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SanctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Type de sanction',
                'choices' => [
                    'Avertissement' => 'Avertissement',
                    'Suspension' => 'Suspension',
                    'Exclusion' => 'Exclusion',
                    'Rappel à l’ordre' => 'Rappel à l’ordre',
                    'Observation disciplinaire' => 'Observation disciplinaire',
                    'Carton jaune' => 'Carton jaune',
                    'Carton rouge' => 'Carton rouge',
                    'Carton blanc' => 'Carton blanc',
                    'Absences répétées' => 'Absences répétées',
                ],
                'placeholder' => 'Choisir un type',
            ])
            ->add('create_at', null, [
                'widget' => 'single_text',
            ])
            ->add('reason', TextareaType::class)
            ->add('match_context', EntityType::class, [
                'class' => Events::class,
                'choice_label' => 'name',
                'placeholder' => 'Aucun événement',
                'required' => false,
            ])
            ->add('player', EntityType::class, [
                'class' => Player::class,
                'choice_label' => function($player) {
                    return $player->getFirstname() . ' ' . $player->getLastname();
                },
                'placeholder' => 'Choisir un joueur',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sanction::class,
        ]);
    }
}
