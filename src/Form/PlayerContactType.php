<?php

namespace App\Form;

use App\Entity\ContactPersons;
use App\Entity\Player;
use App\Entity\PlayerContact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('relationType', ChoiceType::class, [
                'choices' => [
                    'Père' => 'dad',
                    'Mère' => 'mother',
                    'Tuteur' => 'guardian',
                    'Pérsone à prévenir' => 'emergency_contact'
                ],
                'placeholder' => 'Choisir une relation',
            ])
            // ->add('player', EntityType::class, [
            //     'class' => Player::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('contactPerson', EntityType::class, [
            //     'class' => ContactPersons::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayerContact::class,
        ]);
    }
}
