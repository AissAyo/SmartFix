<?php

namespace App\Type;

use    App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdminAuthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your email']),
                    new Email(['message' => 'Please enter a valid email address'])
                ],
                'attr' => [
                    'placeholder' => 'smartfix@gmail.com'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'mapped' => false, // We'll handle this separately in the controller
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a password']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Password should be at least {{ limit }} characters',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'At least 8 characters'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
            'validation_groups' => ['registration']
        ]);
    }

}