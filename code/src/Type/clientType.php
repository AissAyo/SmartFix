<?php

namespace App\Type;

use App\Entity\Mechanic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2, 'max' => 50])
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Email()
                ],
            ])
            ->add('roles', TextType::class, [
                'label' => 'Roles',
                'required' => false,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => false,
                'constraints' => [
                    new Length(['min' => 6])
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Phone Number',
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\+?[0-9]{10,15}$/',
                        'message' => 'Please enter a valid phone number.'
                    ])
                ],
            ])
            ->add('logo', TextType::class, [
                'label' => 'Logo',
                'required' => false,
            ])
         ->add('username', TextType::class, [
                'label' => 'Name',
                'required' => true,
               'constraints' => [
               new NotBlank(),
                new Length(['min' => 2, 'max' => 50])
        ],
    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mechanic::class,
        ]);
    }
}
