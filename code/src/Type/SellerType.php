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
            ->add('username', TextType::class, [
                'label' => 'Username',
                'required' => true,
            ])
            ->add('contactInfo', TextType::class, [
                'label' => 'Contact Info',
                'required' => true,
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Phone Number',
                'required' => true,
            ])
            ->add('garageAddress', TextType::class, [
                'label' => 'Garage Address',
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