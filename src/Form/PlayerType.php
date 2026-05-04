<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(message: 'le nom est obligatoir'),
                    new Length(
                        min: 2,
                        max: 255
                    ),
                ],
                'attr' => [
                    'maxlength' => 255,
                    'placeholder' => 'ex. DU PONT'
                ],
            ])
            ->add('firstname', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(message: 'le prénom est obligatoir'),
                    new Length(
                        min: 2,
                        max: 255
                    ),
                ],
                'attr' => [
                    'maxlength' => 255,
                    'placeholder' => 'ex. Jean'
                ]
            ])
            ->add('birth_date', null, [
                'widget' => 'single_text',
            ])
            // ->add('number', IntegerType::class, [
            //     'required' => false,
            //     'constraints' => [
            //         new Length(
            //             min: 1,
            //             max: 255
            //         )
            //     ],
            //     'attr' => [
            //         'maxlength' => 255,
            //         'placeholder' => '10'
            //     ],
            // ])
            ->add('address', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(
                        min: 3,
                        max: 500
                    )
                ],
                'attr' => [
                    'maxlength' => 500,
                    'placeholder' => 'ex. 10 rue des capucins'
                ],
            ])
            ->add('pc', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(
                        min: 4,
                        max: 6
                    )
                ],
                'attr' => [
                    'maxlength' => 6,
                    'placeholder' => 'ex. 33000'
                ],
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(
                        min: 2,
                        max: 255
                    )
                ],
                'attr' => [
                    'maxlength' => 255,
                    'placeholder' => 'ex. BORDEAUX'
                ],
            ])
            ->add('phone_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(
                        min: 5,
                        max: 20
                    )
                ],
                'attr' => [
                    'maxlength' => 20,
                    'placeholder' => 'ex. 06 10 16 20 30'
                ],
            ])
            ->add('email', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(
                        min: 3,
                        max: 300
                    )
                ],
                'attr' => [
                    'maxlength' => 300,
                    'placeholder' => 'ex. j.dupont@example.com'
                ],
            ])
            ->add('license_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(
                        min: 2,
                        max: 255
                    )
                ],
                'attr' => [
                    'maxlength' => 255,
                    'placeholder' => 'ex. 11035A20'
                ],
            ])
            // ->add('photo')
            // ->add('team', EntityType::class, [
            //     'class' => Team::class,
            //     'choice_label' => 'name',
            // ])
            // ->add('Submit', SubmitType::class, [
            //     'label'    => 'Envoyer'
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
