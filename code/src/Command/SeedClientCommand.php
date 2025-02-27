<?php

namespace App\Command;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SeedClientCommand extends Command
{
    protected static $defaultName = 'app:seed-clients';
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription('Seed the database with client data');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $client = new Client();
            $client->setUsername($faker->userName);
            $client->setPassword(password_hash('password', PASSWORD_BCRYPT));
            $client->setRoles(['ROLE_CLIENT']);
            $client->setVerificationStatus($faker->boolean);
            $client->setDateInscription(new \DateTimeImmutable());
            $client->setLoyaltyPoints($faker->numberBetween(0, 1000));
            $client->setAddress($faker->address);
            $client->setName($faker->name);

            $this->entityManager->persist($client);
        }

        $this->entityManager->flush();

        $io->success('Successfully seeded 100 clients.');

        return Command::SUCCESS;
    }
}