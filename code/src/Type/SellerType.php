<?php

namespace App\Type;

use App\Entity\Seller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class SellerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a name.',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Name must be at least {{ limit }} characters long.',
                        'maxMessage' => 'Name cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email address.',
                    ]),
                    new Email([
                        'message' => 'Please enter a valid email address.',
                    ]),
                ],
            ])
            ->add('contactInfo', TextType::class, [
                'label' => 'Contact Info',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter contact information.',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 100,
                        'minMessage' => 'Contact info must be at least {{ limit }} characters long.',
                        'maxMessage' => 'Contact info cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Password must be at least {{ limit }} characters long.',
                    ]),
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Phone Number',
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\+?[0-9]{10,15}$/',
                        'message' => 'Please enter a valid phone number (e.g., +1234567890).',
                    ]),
                ],
            ])
            ->add('logoFile', VichFileType::class, [
                'label' => 'Logo',
                'required' => false,
                'allow_delete' => true, // Allow file deletion
                'download_uri' => true, // Add a download link
                'constraints' => [
                    new Image([
                        'maxSize' => '2M', // Maximum file size (2MB)
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], // Allowed file types
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG, or GIF).',
                    ]),
                ],
            ])
            ->add('workingHours', TextType::class, [
                'label' => 'Working Hours',
                'required' => false,
                'property_path' => 'working_hours', // This maps form field to entity property
                'constraints' => [
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Working hours cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seller::class,
        ]);
    }
}
