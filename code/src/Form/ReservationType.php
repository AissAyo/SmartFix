<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Vehicule;
use App\Entity\Service;
use App\Entity\Garage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'attr' => [
                    'class' => 'form-control',
                    'min' => (new \DateTime())->format('Y-m-d\TH:i'),
                ],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Pending' => 'pending',
                    'Confirmed' => 'confirmed',
                    'Cancelled' => 'cancelled',
                ],
                'attr' => ['class' => 'form-select'],
                'label' => 'Status',
            ])
            ->add('estimatedPrice', NumberType::class, [
                'label' => 'Estimated Price',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter estimated price',
                    'step' => '0.01',
                ],
            ])
            ->add('vehicle', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => function (Vehicule $vehicle) {
                    return sprintf(
                        '[%d] %s - %s (%s km)',
                        $vehicle->getId(),
                        $vehicle->getPlateNumber(),
                        $vehicle->getColor(),
                        $vehicle->getMileage()
                    );
                },
                'attr' => ['class' => 'form-select'],
                'label' => 'Vehicle',
                'query_builder' => function ($repository) {
                    return $repository->createQueryBuilder('v')
                        ->orderBy('v.id', 'ASC');
                },
                'choice_value' => 'id',
            ])
            // ->add('service', EntityType::class, [
            //     'class' => Service::class,
            //     'choice_label' => function (Service $service) {
            //         return $service->getName() . ' - $' . $service->getPrice();
            //     },
            //     'attr' => ['class' => 'form-select'],
            //     'label' => 'Service',
            // ])
            ->add('notes', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Add any additional notes or requirements...',
                ],
                'label' => 'Notes',
            ])
            ->add('service', ChoiceType::class, [
                'label' => 'Service',
                'choices'  => [
                    'Vidange' => 'vidange',
                    'Pneus' => 'pneus',
                    'Diagnostic' => 'diagnostic',
                ],
                'placeholder' => 'Choisissez un service',
                'mapped' => false, // important si tu veux pas que ça touche à l'entité
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
} 