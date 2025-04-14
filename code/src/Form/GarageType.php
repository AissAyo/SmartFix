<?php
namespace App\Form;

use App\Entity\Garage;
use App\Entity\Mechanic;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GarageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emailGarage', EmailType::class)
            ->add('rating', ChoiceType::class,[
                'choices' => [
                    '*'=>1,
                    '**'=>2,
                    '***'=>3,
                    '****'=>4,
                    '*****'=>5,
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Open' => 'Open',
                    'Closed' => 'Closed',
                    'Pending' => 'Pending',
                ],
            ])
            ->add('name', TextType::class)
            ->add('workingHours', TextType::class, [
                'required' => false,
            ])
            ->add('mechanic', EntityType::class, [
                'class' => Mechanic::class,
                'choice_label' => 'name', // adjust as needed
            ])
            // Add fields for the new address input
            ->add('location', LocationType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Garage::class,
        ]);
    }
}
