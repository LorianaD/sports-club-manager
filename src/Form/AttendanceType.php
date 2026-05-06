<?php

namespace App\Form;

use App\Entity\Attendance;
use App\Entity\AttendanceStatus;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reason')
            ->add('comment', TextareaType::class)
            ->add('create_at', null, [
                'widget' => 'single_text',
            ])
            ->add('attendance_status', EntityType::class, [
                'class' => AttendanceStatus::class,
                'choice_label' => 'label',
                'placeholder' => 'Choisir un statut',
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
            'data_class' => Attendance::class,
        ]);
    }
}
