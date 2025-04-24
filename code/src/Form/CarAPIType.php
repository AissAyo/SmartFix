<?php

namespace App\Form;

use App\Entity\CarAPI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarAPIType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('make', TextType::class, [
                'label' => 'Make',
                'required' => true,
                'attr' => ['maxlength' => 100]
            ])
            ->add('model', TextType::class, [
                'label' => 'Model',
                'required' => true,
                'attr' => ['maxlength' => 100]
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Year',
                'required' => true,
                'attr' => ['min' => 1900, 'max' => (int)date('Y') + 1]
            ])
            ->add('trim', TextType::class, [
                'label' => 'Trim',
                'required' => false,
                'attr' => ['maxlength' => 100]
            ])
            ->add('horsepower', IntegerType::class, [
                'label' => 'Horsepower',
                'required' => false,
                'attr' => ['min' => 0]
            ])
            ->add('torque', IntegerType::class, [
                'label' => 'Torque',
                'required' => false,
                'attr' => ['min' => 0]
            ])
            ->add('engine', TextType::class, [
                'label' => 'Engine',
                'required' => false,
                'attr' => ['maxlength' => 50]
            ])
            ->add('fuelType', ChoiceType::class, [
                'label' => 'Fuel Type',
                'required' => false,
                'choices' => [
                    'Gasoline' => 'Gasoline',
                    'Diesel' => 'Diesel',
                    'Electric' => 'Electric',
                    'Hybrid' => 'Hybrid',
                    'Plug-in Hybrid' => 'Plug-in Hybrid',
                    'Hydrogen' => 'Hydrogen',
                ],
                'placeholder' => 'Select fuel type',
            ])
            ->add('transmission', ChoiceType::class, [
                'label' => 'Transmission',
                'required' => false,
                'choices' => [
                    'Automatic' => 'Automatic',
                    'Manual' => 'Manual',
                    'CVT' => 'CVT',
                    'Dual-Clutch' => 'Dual-Clutch',
                ],
                'placeholder' => 'Select transmission',
            ])
            ->add('drivetrain', ChoiceType::class, [
                'label' => 'Drivetrain',
                'required' => false,
                'choices' => [
                    'FWD' => 'FWD',
                    'RWD' => 'RWD',
                    'AWD' => 'AWD',
                    '4WD' => '4WD',
                ],
                'placeholder' => 'Select drivetrain',
            ])
            ->add('bodyType', ChoiceType::class, [
                'label' => 'Body Type',
                'required' => false,
                'choices' => [
                    'Sedan' => 'Sedan',
                    'Coupe' => 'Coupe',
                    'Hatchback' => 'Hatchback',
                    'SUV' => 'SUV',
                    'Crossover' => 'Crossover',
                    'Truck' => 'Truck',
                    'Van' => 'Van',
                    'Wagon' => 'Wagon',
                    'Convertible' => 'Convertible',
                ],
                'placeholder' => 'Select body type',
            ])
            ->add('doors', IntegerType::class, [
                'label' => 'Number of Doors',
                'required' => false,
                'attr' => ['min' => 1, 'max' => 6]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarAPI::class,
        ]);
    }
}