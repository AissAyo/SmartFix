<?php

namespace App\Command;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:seed-services',  // Command name
    description: 'Seed the database with fake service data'
)]
class SeedServiceCommand extends Command
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Seed the database with fake service data')
            ->setHelp('This command allows you to populate the services table with fake data...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();  

        $output->writeln('Seeding services...');
        $categoryServices = $this->em->getRepository(CategoryService::class)->findAll();

        for ($i = 0; $i < 10; $i++) {
            $service = new service();
            $service->setServiceName($faker->servicename)  
                ->setPrix($faker->Prix) 
                ->setDescription($faker->Description)  
                ->setStatus($faker->randomelement(['Open','closed'])); 
                if (!empty($categoryServices)) {
                    $randomCategory = $faker->randomElement($categoryServices);
                    $service->setCategoryService($randomCategory);
                }

            $this->em->persist($service);
        }

        // Flush to save all generated entities to the database
        $this->em->flush();

        $output->writeln('Seeding completed!');

        return Command::SUCCESS;
    }
}
