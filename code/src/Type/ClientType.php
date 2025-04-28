<?php

namespace App\Type;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Full Name',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your full name']),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Name must be at least {{ limit }} characters',
                        'maxMessage' => 'Name cannot be longer than {{ limit }} characters'
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'John Doe'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your email']),
                    new Email(['message' => 'Please enter a valid email address'])
                ],
                'attr' => [
                    'placeholder' => 'your@email.com'
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
            ])
            ->add('verificationStatus', ChoiceType::class, [
                'choices' => [
                    'Verified' => 'verified',
                    'Rejected' => 'rejected',
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Phone Number',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your phone number']),
                    new Regex([
                        'pattern' => '/^(\+212|0)(6|7|5)[0-9]{8}$/',
                        'message' => 'Please enter a valid Moroccan phone number (e.g. 0612345678 or +212612345678)'
                    ])
                ],
                'attr' => [
                    'placeholder' => '06 12 34 56 78'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your city'])
                ],
                'attr' => [
                    'placeholder' => 'Casablanca'
                ]
            ])
            ->add('photoProfilFile', FileType::class, [
                'label' => 'Profile Picture (optional)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG or PNG)',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
            'validation_groups' => ['registration']
        ]);
    }
}