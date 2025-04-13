<?php

namespace App\Command;

use App\Entity\Garage;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:seed-garages',  // Command name
    description: 'Seed the database with fake garage data'
)]
class SeedGaragesCommand extends Command
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
            ->setDescription('Seed the database with fake garage data')
            ->setHelp('This command allows you to populate the garages table with fake data...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();  // Initialize Faker

        $output->writeln('Seeding garages...');

        // Generate 10 fake garages and persist them to the database
        for ($i = 0; $i < 10; $i++) {
            $garage = new Garage();
            $garage->setRating($faker->randomFloat(2, 1, 5))  // Rating between 1.0 and 5.0
                ->setStatus($faker->randomElement(['open', 'closed', 'under_maintenance']))  // Status of the garage
                ->setName($faker->company)  // Fake garage name
                ->setLocation($faker->address);  // Fake location/address

            // Persist the garage entity
            $this->em->persist($garage);
        }

        // Flush to save all generated entities to the database
        $this->em->flush();

        $output->writeln('Seeding completed!');

        return Command::SUCCESS;
    }
}
