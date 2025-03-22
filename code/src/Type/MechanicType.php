<?php


namespace App\Type;

use App\DTO\clientSignupDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MechanicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter your name']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter your email']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter your password']
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirm Password',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Confirm your password']
            ])
            ->add('address', TextType::class, [
                'label' => 'Address',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter your address']
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone Number',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter your phone number']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Sign Up',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => clientSignupDTO::class,
        ]);
    }
}