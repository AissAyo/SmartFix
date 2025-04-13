<?php

namespace App\Type;

use App\Entity\Mechanic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Validator\Constraints\File;


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
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => true,
                'constraints' =>  [
                    new Assert\NotBlank(['message' => 'Please enter a password.']),
                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'Password should be at least {{ limit }} characters.',
                    ]),
                ],
            ])

            ->add('city', ChoiceType::class, [
                'label' => 'City',
                'required' => true,
                'choices'  => [
                    'Casablanca' => 'casablanca',
                    'Rabat' => 'rabat',
                    'Fès' => 'fes',
                    'Marrakech' => 'marrakech',
                    'Tangier' => 'tangier',
                    'Agadir' => 'agadir',
                    'Meknès' => 'meknes',
                    'Oujda' => 'oujda',
                    'Tétouan' => 'tetouan',
                    'Safi' => 'safi',
                    'Mohammedia' => 'mohammedia',
                    'El Jadida' => 'el_jadida',
                    'Béni Mellal' => 'beni_mellal',
                    'Nador' => 'nador',
                    'Khouribga' => 'khouribga',
                    'Kénitra' => 'kenitra',
                    'Laâyoune' => 'laayoune',
                    'Errachidia' => 'errachidia',
                    'Taroudant' => 'taroudant',
                    'Taza' => 'taza',
                    'Tinghir' => 'tinghir',
                    'Settat' => 'settat',
                    'Sidi Kacem' => 'sidi_kacem',
                    'El Hoceima' => 'el_hoceima',
                    'Berkane' => 'berkane',
                    'Beni Mella' => 'beni_mella',
                    'Khemisset' => 'khemisset',
                    'Taza' => 'taza',
                    'Fkih Ben Salah' => 'fkih_ben_salah',
                    'Ouarzazate' => 'ouarzazate',
                    'Midelt' => 'midelt',
                    'Ifrane' => 'ifrane',
                    'Ksar el-Kébir' => 'ksar_el_kebir',
                    'Nador' => 'nador',
                    'Azrou' => 'azrou',
                    'Guelmim' => 'guelmim',
                    'Al Hoceima' => 'al_hoceima',
                    'Sidi Ifni' => 'sidi_ifni',
                    'Dakhla' => 'dakhla',
                    'M’diq' => 'mdiq',
                    'Chefchaouen' => 'chefchaouen',
                    'Imzouren' => 'imzouren',
                ],
                'placeholder' => 'Choose a city',
            ])
            ->add('address',TextareaType::class, [
                'label' => 'Adress',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please enter a address.']),
                ]
            ])
            ->add('garageAddress', TextareaType::class, [
                'label' => 'Garage Address',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please enter a garage address.']),
                ]
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
            ->add('certifications', TextType::class, [
                'label' => 'Certifications',
                'required' => false,
                'data' => $options['data']->getCertifications() ?? [],  // Ensure default is an empty array
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please enter certifications.']),
                ]
            ])

            ->add('phone', TextType::class, [
                'label' => 'Phone Number',
                'required' => false,
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\+?[0-9]{10,15}$/',
                        'message' => 'Please enter a valid phone number (e.g., +1234567890).',
                    ]),
                ],
            ])
            ->add('logoFile', FileType::class, [
                'label' => 'Logo',
                'required' => false,
                'mapped' => false,

                'constraints' => [
                    new Assert\Image([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG, or GIF).',
                    ]),
                ],
            ])
            ->add('MechanicphotoProfilFile', FileType::class, [
                'label' => 'Profile Photo',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Please upload a valid profile photo',
                    ])
                ]
            ]);

    }
}