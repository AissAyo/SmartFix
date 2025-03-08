<?php   

namespace App\Form\Type;

use App\Entity\Seller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('password')
            ->add('phone')
            ->add('address')
            ->add('ville')
            ->add('garageName')
            ->add('garageAddress')
            ->add('phoneNumber')
            ->add('workingHours')
            ->add('Logo');
       
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Seller::class,
            ]);
        }
}