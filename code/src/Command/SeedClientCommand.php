<?php

namespace App\Command;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:seed-clients',  // Command name
    description: 'Seed the database with fake client data'
)]
class SeedClientCommand extends Command
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
            ->setDescription('Seed the database with fake client data')
            ->setHelp('This command allows you to populate the clients table with fake data...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
{
    $faker = Factory::create();  // Initialize Faker

    $output->writeln('Seeding clients...');

    // Generate 10 fake clients and persist them to the database
    for ($i = 0; $i < 50; $i++) {
        $client = new Client();
        $client->setVerificationStatus($faker->boolean)  // Random boolean for verification status
            ->setDateInscription(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', 'now')))  // Convert DateTime to DateTimeImmutable
            ->setLoyaltyPoints($faker->numberBetween(0, 1000))  // Random loyalty points between 0 and 1000
            ->setUsername($faker->userName)
            ->setAddress($faker->address)
            ->setName($faker->name)
            ->setPassword($faker->password);

        // Persist the client entity
        $this->em->persist($client);
    }

    // Flush to save all generated entities to the database
    $this->em->flush();

    $output->writeln('Seeding completed!');

    return Command::SUCCESS;
}}