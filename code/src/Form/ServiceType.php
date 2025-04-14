<?php
namespace App\Form;

use App\Entity\Service;
use App\Entity\CategoryService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('serviceName')
            ->add('serviceCode')
            ->add('prix', MoneyType::class, [
                'currency' => 'USD', // Change as needed
            ])
            ->add('description')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Active' => 'ACTIVE',
                    'Inactive' => 'INACTIVE',
                ],
            ])
            ->add('categoryService', EntityType::class, [
                'class' => CategoryService::class,
                'choice_label' => 'Categoryname', // Change depending on your entity
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
