<?php

namespace App\Command;

use App\Entity\Seller;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:seed-sellers',  // Command name
    description: 'Seed the database with fake seller data'
)]
class SeedSellerCommand extends Command
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
            ->setDescription('Seed the database with fake seller data')
            ->setHelp('This command allows you to populate the sellers table with fake data...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();  // Initialize Faker

        $output->writeln('Seeding sellers...');

        // Generate 10 fake sellers and persist them to the database
        for ($i = 0; $i < 20; $i++) {
            // Generate random values for the required fields
            $phone_number = $faker->phoneNumber;
            $workingHours = $faker->randomElement(['08:00-17:00', '09:00-18:00', '10:00-19:00']);
            $contactInfo = $faker->address;

            // Create Seller object and pass the arguments to the constructor
            $seller = new Seller($phone_number, $workingHours, $contactInfo);
            $seller->setUsername($faker->userName)
                ->setEmail($faker->unique()->safeEmail)
                ->setPassword(password_hash('password123', PASSWORD_BCRYPT)) // Default password
                ->setRole('Seller');

            // Persist the seller entity
            $this->em->persist($seller);
        }

        // Flush to save all generated entities to the database
        $this->em->flush();

        $output->writeln('Seeding completed!');

        return Command::SUCCESS;
    }
}
