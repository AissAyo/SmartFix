<?php
namespace App\Command;

use App\Entity\Garage;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SeedGaragesCommand extends Command
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected static $defaultName = 'app:seed-garages';

    protected function configure(): void
    {
        $this
            ->setDescription('Seed the database with fake garage data')
            ->setHelp('This command allows you to populate the garages table with fake data...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();

        $output->writeln('Seeding garages...');

        // Generate 10 fake garages and persist them
        for ($i = 0; $i < 10; $i++) {
            $garage = new Garage();
            $garage->setRating($faker->randomFloat(1, 1, 5)) // Rating from 1.0 to 5.0
                ->setStatus($faker->randomElement(['open', 'closed', 'under_maintenance'])) // Status of the garage
                ->setName($faker->company) // Fake garage name
                ->setLocation($faker->address) // Fake location/address
                ->setId($faker->unique()->randomNumber()); // Unique fake ID

            $this->em->persist($garage);
        }

        // Flush to save all generated entities to the database
        $this->em->flush();

        $output->writeln('Seeding completed!');

        return Command::SUCCESS;
    }
}
