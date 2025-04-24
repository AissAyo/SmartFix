<?php
namespace App\Form\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Garage;
use App\Entity\Service;

class AddGarageFieldSubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT   => 'onPreSubmit',
        ];
    }

    private function addGarageField($form, $service = null)
    {
        $garages = [];

        if ($service) {
            $categoryService = $service->getCategoryService();
            if ($categoryService) {
                if($garages){
                    dd($garages);
                }
            } else {
                dump('No category service found for this service.');
            }
        } else {
            dump('No service provided.');
        }
        $form->add('garage', EntityType::class, [
            'class' => Garage::class,
            'choices' => $garages,
            'choice_label' => function (Garage $garage) {
                return sprintf('%s (%s)', $garage->getName(), $garage->getLocation()->getCity());
            },
            'placeholder' => 'Choose a garage',
            'required' => false,
            'mapped' => false, // since Reservation doesn't have this field
            'attr' => ['class' => 'form-control'],
        ]);
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        $service = $data ? $data->getService() : null;
        $this->addGarageField($form, $service);
    }

    public function onPreSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (isset($data['service'])) {
            $service = $this->em->getRepository(Service::class)->find($data['service']);
            $this->addGarageField($form, $service);
        }
    }
}
