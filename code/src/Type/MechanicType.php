<?php

namespace App\Type;

use App\Entity\Mechanic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class MechanicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Full Name',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please enter a name.']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Name must be at least {{ limit }} characters long.',
                        'maxMessage' => 'Name cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please enter an email address.']),
                    new Assert\Email(['message' => 'Please enter a valid email address.']),
                ],
            ])
            ->add('specialization', ChoiceType::class, [
                'label' => 'Specialization',
                'required' => false,
                'choices' => [
                    'General Mechanic' => 'general',
                    'Engine Specialist' => 'engine',
                    'Electrical Systems' => 'electrical',
                    'Transmission' => 'transmission',
                    'Brakes' => 'brakes',
                    'Suspension' => 'suspension',
                ],
                'placeholder' => 'Select a specialization',
            ])
            ->add('experienceYears', IntegerType::class, [
                'label' => 'Years of Experience',
                'required' => false,
                'constraints' => [
                    new Assert\Range([
                        'min' => 0,
                        'max' => 50,
                        'notInRangeMessage' => 'Experience should be between {{ min }} and {{ max }} years.'
                    ]),
                ],
            ])
            // Replace the certifications field with this:
            ->add('certifications', TextareaType::class, [
                'label' => 'Certifications',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter one certification per line',
                    'rows' => 3
                ],
                'help' => 'Enter one certification per line',
                'getter' => function (Mechanic $mechanic) {
                    return implode("\n", $mechanic->getCertifications());
                },
                'setter' => function (Mechanic $mechanic, string $certifications) {
                    $mechanic->setCertifications(
                        array_filter(
                            array_map('trim', explode("\n", $certifications)),
                            function($item) { return !empty($item); }
                        )
                    );
                },
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Phone Number',
                'required' => false,
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\+?[0-9]{10,15}$/',
                        'message' => 'Please enter a valid phone number (e.g., +1234567890).',
                    ]),
                ],
            ])
            ->add('logoFile', VichFileType::class, [
                'label' => 'Profile Photo',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'delete_label' => 'Remove current photo',
                'constraints' => [
                    new Assert\Image([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG, or GIF).',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => !$options['is_edit'],
                'help' => $options['is_edit'] ? 'Leave blank to keep current password' : null,
                'constraints' => $options['is_edit'] ? [] : [
                    new Assert\NotBlank(['message' => 'Please enter a password.']),
                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'Password should be at least {{ limit }} characters.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mechanic::class,
            'is_edit' => false,
        ]);

        $resolver->setAllowedTypes('is_edit', 'bool');
    }
}