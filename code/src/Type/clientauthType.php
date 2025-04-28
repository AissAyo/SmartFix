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


class clientauthType extends AbstractType
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
            ->add('city', ChoiceType::class, [
                'label' => 'City',
                'required' => true,
                'choices' => $this->getCityChoices(),
                'placeholder' => 'Choose a city',
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
    private function getCityChoices(): array
    {
        return [
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
            'Khemisset' => 'khemisset',
            'Fkih Ben Salah' => 'fkih_ben_salah',
            'Ouarzazate' => 'ouarzazate',
            'Midelt' => 'midelt',
            'Ifrane' => 'ifrane',
            'Ksar el-Kébir' => 'ksar_el_kebir',
            'Azrou' => 'azrou',
            'Guelmim' => 'guelmim',
            'Al Hoceima' => 'al_hoceima',
            'Sidi Ifni' => 'sidi_ifni',
            'Dakhla' => 'dakhla',
            'M’diq' => 'mdiq',
            'Chefchaouen' => 'chefchaouen',
            'Imzouren' => 'imzouren',
        ];
    }
}