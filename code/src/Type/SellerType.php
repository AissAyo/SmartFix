<?php
namespace App\Type;

use App\Entity\Seller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'name',
                'required' => true,
            ])

            ->add('email', TextType::class, [
                'label' => 'E-mail',
                'required' => true,
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Garage Address',
                'required' => true,
            ])
             ->add('Logo', TextType::class, [
                 'label' => 'Logo',
                 'required' => true,
            ])
            ->add('workingHours', TextType::class, [
            'label' => 'workingHours',
            'required' => true,
            ])
            ->add('contactInfo', TextType::class, [
                'label' => 'Contact Info',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seller::class,
        ]);
    }
}