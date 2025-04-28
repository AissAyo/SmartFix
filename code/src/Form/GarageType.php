<?php
namespace App\Form;

use App\Entity\Garage;
use App\Entity\Mechanic;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GarageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emailGarage', EmailType::class)
            ->add('rating', ChoiceType::class,[
                'choices' => [
                    '*'=>1,
                    '**'=>2,
                    '***'=>3,
                    '****'=>4,
                    '*****'=>5,
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Open' => 'Open',
                    'Closed' => 'Closed',
                    'Pending' => 'Pending',
                ],
            ])
            ->add('City', ChoiceType::class, [
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
            ->add('name', TextType::class)
            ->add('workingHours', TextType::class, [
                'required' => false,
            ])
            ->add('mechanic', EntityType::class, [
                'class' => Mechanic::class,
                'choice_label' => 'name', // adjust as needed
            ])
            // Add fields for the new address input
            ->add('location', LocationType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Garage::class,
        ]);
    }
}
