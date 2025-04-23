<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Vehicule;
use App\Form\EventSubscriber\AddServiceFieldSubscriber; // don't forget this use statement
use App\Entity\Client;
use App\Form\EventSubscriber\AddGarageFieldSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ReservationType extends AbstractType
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//        $builder
//            ->add('reservationDate', DateTimeType::class, [
//                'label' => 'Reservation Date & Time',
//                'widget' => 'single_text',
//                'html5' => true,
//                'attr' => ['class' => 'datetimepicker'],
//            ])
//            ->add('status', ChoiceType::class, [
//                'label' => 'Status',
//                'choices' => [
//                    'Pending' => 'pending',
//                    'Confirmed' => 'confirmed',
//                    'In Progress' => 'in_progress',
//                    'Completed' => 'completed',
//                    'Cancelled' => 'cancelled',
//                ],
//                'attr' => ['class' => 'form-control'],
//            ])
//            ->add('estimatedPrice', MoneyType::class, [
//                'label' => 'Estimated Price',
//                'currency' => 'USD',
//                'scale' => 2,
//                'attr' => ['class' => 'form-control'],
//            ])
//            ->add('vehicle', EntityType::class, [
//                'label' => 'Vehicle',
//                'class' => Vehicule::class,
//                'choice_label' => function(Vehicule $vehicle) {
//                    return sprintf('%s %s (%s)', $vehicle->getCarAPI()->getMake(), $vehicle->getCarAPI()->getModel(), $vehicle->getPlateNumber());
//                },
//                'attr' => ['class' => 'form-control'],
//            ])
//            ->addEventSubscriber(new AddServiceFieldSubscriber($this->em))
//
//            ->add('notes', TextareaType::class, [
//                'label' => 'Additional Notes',
//                'required' => false,
//                'attr' => [
//                    'class' => 'form-control',
//                    'rows' => 3,
//                ],
//            ])
//            ->add('client', EntityType::class, [
//                'class' => Client::class,
//                'choice_label' => function (Client $client) {
//                    return $client->getName() ;
//                },
//                'mapped' => false, // important: no direct relation
//                'placeholder' => 'Choose a client',
//                'attr' => ['class' => 'form-control', 'id' => 'client_selector'],
//            ])
//            ->add('vehicle', EntityType::class, [
//                'class' => Vehicule::class,
//                'choice_label' => function (Vehicule $vehicule) {
//                    return sprintf('%s (%s)', $vehicule->getCarAPI()->getModel(), $vehicule->getPlateNumber());
//                },
//                'placeholder' => 'Choose a vehicle',
//                'attr' => ['class' => 'form-control', 'id' => 'vehicle_selector'],
//            ])
//            ->addEventSubscriber(new AddGarageFieldSubscriber($this->em));
        $builder
            // Client Information
            ->add('client_name', TextType::class, [
                'label' => 'Client Name',
                'attr' => ['class' => 'form-control']
            ])

            // Reservation Information
            ->add('id', TextType::class, [
                'label' => 'Reservation ID',
                'disabled' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'choices' => [
                    'Pending' => 'pending',
                    'Confirmed' => 'confirmed',
                    'In Progress' => 'in_progress',
                    'Completed' => 'completed',
                    'Cancelled' => 'cancelled',
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('reservationDate', DateTimeType::class, [
                'label' => 'Reservation Date & Time',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control datetimepicker']
            ])
            ->add('notes', TextareaType::class, [
                'label' => 'Notes',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3]
            ])

            // Service Information
            ->add('service_name', TextType::class, [
                'label' => 'Service',
                'attr' => ['class' => 'form-control']
            ])

            // Garage Information
            ->add('garage_name', TextType::class, [
                'label' => 'Garage',
                'attr' => ['class' => 'form-control']
            ])
            ->add('address', TextType::class, [
                'label' => 'Address',
                'attr' => ['class' => 'form-control']
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'attr' => ['class' => 'form-control']
            ])

            // Vehicle Information
            ->add('make', TextType::class, [
                'label' => 'Car Make',
                'attr' => ['class' => 'form-control']
            ])
            ->add('model', TextType::class, [
                'label' => 'Car Model',
                'attr' => ['class' => 'form-control']
            ])
            ->add('year', TextType::class, [
                'label' => 'Year',
                'attr' => ['class' => 'form-control']
            ])
            ->add('fuelType', TextType::class, [
                'label' => 'Fuel Type',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}