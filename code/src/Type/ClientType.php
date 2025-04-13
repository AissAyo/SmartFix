<?php

namespace App\Type;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
                    new Length(['min' => 2, 'max' => 50]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Please enter an email address.']),
                    new Email(['message' => 'Please enter a valid email address.']),
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
                    new Length(['min' => 6, 'minMessage' => 'Password must be at least {{ limit }} characters long.']),
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
                ],
                'placeholder' => 'Choose a city',
            ])

            ->add('phone', TextType::class, [
                'label' => 'Phone Number',
                'required' => false,

                'constraints' => [
                    new Regex([
                        'pattern' => '/^(\+212|212|0)(6|7|8|5)[0-9]{8}$/',
                        'message' => 'Please enter a valid phone number. 0609683488 or +212609683488',
                    ]),
                ],
            ])
            ->add('ClientphotoProfilFile', FileType::class, [
                'label' => 'Profile Photo',
                'required' => false,

                'mapped' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG, or GIF).',
                    ]),
                ],
            ])
            ->add('verificationStatus', ChoiceType::class, [
                'label' => 'Verification Status',
                'choices' => [
                    'Verified' => 1,
                    'Unverified' => 0,
                ],
                'expanded' => false, // dropdown
                'multiple' => false,
                'required' => true,
            ]);

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
