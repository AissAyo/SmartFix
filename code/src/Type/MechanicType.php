<?php
namespace App\Type;

use App\Entity\Mechanic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MechanicType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
$builder
->add('name', TextType::class, [
'label' => 'Full Name',
'required' => true,
'constraints' => [
new Assert\NotBlank(),
new Assert\Length(['min' => 2, 'max' => 50]),
],
])
->add('email', EmailType::class, [
'label' => 'Email Address',
'required' => true,
'constraints' => [
new Assert\NotBlank(),
new Assert\Email(),
],
])
->add('password', PasswordType::class, [
'label' => 'Password',
'required' => true,
'constraints' => [
new Assert\NotBlank(),
new Assert\Length(['min' => 6]),
],
])

->add('city', ChoiceType::class, [
'label' => 'City',
'required' => true,
'choices' => $this->getCityChoices(),
'placeholder' => 'Choose a city',
])
->add('address', TextareaType::class, [
'label' => 'Address',
'required' => true,
'constraints' => [new Assert\NotBlank()],
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
new Assert\Range(['min' => 0, 'max' => 50]),
],
])
->add('certifications', TextType::class, [
'label' => 'Certifications',
'required' => false,
])
->add('photoProfilFile', VichImageType::class, [
    'label' => 'Profile Photo',
    'required' => false,
    'allow_delete' => true, // Allow the user to delete the file
    'download_uri' => true, // Provide a download link for the file
])
//->add('photoProfilFile', VichImageType::class, [
//'label' => 'Profile Photo',
//'required' => false,
//'allow_delete' => true,
//'download_uri' => false,
//])
->add('workingHours', ChoiceType::class, [
'label' => 'Working Hours',
'required' => false,
'placeholder' => 'Select working hours',
'choices' => [
'8 AM - 4 PM' => '8-16',
'9 AM - 5 PM' => '9-17',
'10 AM - 6 PM' => '10-18',
],
]);
}

public function configureOptions(OptionsResolver $resolver): void
{
$resolver->setDefaults([
'data_class' => Mechanic::class,
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
