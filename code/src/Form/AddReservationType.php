<?php   
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Client;
use App\Entity\Service;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Reservation;

class AddReservationType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'id', // Tu peux changer en 'email' ou 'fullName' pour plus de lisibilité
                'label' => 'Client'
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Services disponibles', 
                'required'=> false,
            ])
            ->add('reservationDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}