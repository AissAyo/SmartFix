<?php
namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Garage;
use App\Entity\Mechanic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GarageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('emailGarage', EmailType::class)
            ->add('rating', NumberType::class, [
                'scale' => 2,
                'attr' => ['min' => 0, 'max' => 5]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Actif' => 'active',
                    'Inactif' => 'inactive',
                ]
            ])
            ->add('mechanic', EntityType::class, [
                'class' => Mechanic::class,
                'choice_label' => 'name',
                'required' => true,  // Permet de laisser le champ vide

            ])
            ->add('workingHours', TextType::class, [
                'required' => false,
            ])
            
            ->add('save', SubmitType::class, ['label' => 'Sauvegarder'])
      ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Garage::class,
        ]);
    }
}
