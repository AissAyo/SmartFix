<?php
namespace App\Form\Type;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddNormalClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
                'attr' => ['placeholder' => 'Enter username'],
            ])
            ->add('name', TextType::class, [
                'label' => 'Full Name',
                'attr' => ['placeholder' => 'Enter full name'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Enter email'],
            ])
            ->add('address', TextType::class, [
                'label' => 'Address',
                'required' => false,
                'attr' => ['placeholder' => 'Enter address'],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender',
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female',
                ],
                'placeholder' => 'Select gender',
            ])
            ->add('profile_image', FileType::class, [
                'label' => 'Profile Image',
                'required' => false,
                'mapped' => false,  // non lié à l'entité
                'attr' => ['accept' => 'image/*'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'mapped' => false, // Non mappé directement à l'entité
                'attr' => ['hidden' => true], // Champ caché pour un mot de passe auto-généré
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add Client',
                'attr' => ['class' => 'btn btn-danger w-100 py-2'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class, // L'entité à laquelle ce formulaire est lié
        ]);
    }
}
