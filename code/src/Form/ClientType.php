<?php

namespace App\Form;

use App\Entity\Cart;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('password')
            ->add('email')
            ->add('logo')
            ->add('roles')
            ->add('resetToken')
            ->add('tokenExpiration', null, [
                'widget' => 'single_text',
            ])
            ->add('username')
            ->add('verificationStatus')
            ->add('dateInscription', null, [
                'widget' => 'single_text',
            ])
            ->add('loyaltyPoints')
            ->add('cart', EntityType::class, [
                'class' => Cart::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
