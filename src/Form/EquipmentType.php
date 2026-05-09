<?php

namespace App\Form;

use App\Entity\Inventory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'High-tech' => 'high-tech',
                    'Papeterie' => 'papeterie',
                    'Équipement sportif' => 'equipement',
                    'Textile' => 'textile',
                    'Médical' => 'medical',
                    'Administratif' => 'administratif',
                    'Autre' => 'autre',
                ],
                'placeholder' => 'Sélectionner une catégorie',
            ])
            ->add('stock', IntegerType::class)
            ->add('unit_price', MoneyType::class, [
                'currency' => false,
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Disponible' => 'disponible',
                    'Commandé' => 'commande',
                    'Emprunté' => 'emprunte',
                    'Endommagé' => 'endommage',
                    'En cours d’utilisation' => 'en_cours_utilisation',
                    'Perdu' => 'perdu',
                ],
                'placeholder' => 'Sélectionner un statut',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inventory::class,
        ]);
    }
}
