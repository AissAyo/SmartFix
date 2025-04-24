<?php
namespace App\Form\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;

class AddServiceFieldSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $this->addServiceField($form);
    }

    public function onPreSubmit(FormEvent $event)
    {
        $formData = $event->getData();
        $form = $event->getForm();

        if (empty($formData['service'])) {
            $form->get('service')->addError(new FormError('Service is required.'));
        }
    }

    private function addServiceField(FormInterface $form)
    {
        // Ensure the services are loaded properly from the database
        $services = $this->em->getRepository(Service::class)->findAll();

        $form->add('service', EntityType::class, [
            'class' => Service::class,
            'choices' => $services, // Explicitly load the choices
            'choice_label' => 'name',
            'placeholder' => 'Choose a service',
            'required' => true,
            'attr' => ['class' => 'form-control'],
        ]);
    }
}
