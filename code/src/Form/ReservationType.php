<?php


namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Client;
use App\Entity\Vehicule;
use App\Entity\Service;
use App\Entity\Garage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reservationDate', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'label' => 'Reservation Date & Time',
            ])

            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Confirmed' => 'confirmed',
                    'Pending' => 'pending',
                    'Rejected' => 'rejected',
                ],
            ])

            ->add('notes', TextareaType::class, ['required' => false])

            ->add('vehicle', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => function (Vehicule $vehicule) {
                    return $vehicule->getBrand() . ' ' . $vehicule->getModel();
                },
            ])

            ->add('client', EntityType::class, [
                'class' => Client::class,
                'placeholder' => 'Choose a Client',
                'choice_label' => 'name',
            ])
            ->add('garage', EntityType::class, [
                'class' => Garage::class,
                'choice_label' => 'name',
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'serviceName',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
