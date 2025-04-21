<?php

namespace App\Command;

use App\Entity\Vehicule;
use App\Entity\Client;
use App\Entity\CarAPI;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'app:seed-vehicles',
    description: 'Seeds the database with fake vehicles linked to random clients and car API data',
)]
class SeedVehiculeCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                'count',
                'c',
                InputOption::VALUE_OPTIONAL,
                'Number of vehicles to generate',
                100
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create();

        $io->info('Starting to seed vehicles...');

        try {
            // Get all clients and car API entries
            $clients = $this->entityManager->getRepository(Client::class)->findAll();
            
            // Get only car API entries that have models (not just makes)
            $qb = $this->entityManager->createQueryBuilder();
            $qb->select('ca')
               ->from(CarAPI::class, 'ca')
               ->where('ca.model != :emptyModel')
               ->setParameter('emptyModel', '');
            
            $carApis = $qb->getQuery()->getResult();

            if (empty($clients) || empty($carApis)) {
                $io->error('No clients or car API data found. Please seed clients and car API data first.');
                return Command::FAILURE;
            }

            $numberOfVehicles = (int) $input->getOption('count');
            $colors = ['Red', 'Blue', 'Black', 'White', 'Silver', 'Gray', 'Green', 'Yellow'];

            for ($i = 0; $i < $numberOfVehicles; $i++) {
                // Get random client and car API
                $randomClient = $clients[array_rand($clients)];
                $randomCarApi = $carApis[array_rand($carApis)];

                // Generate a unique VIN (17 characters)
                $vin = $faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}');

                // Generate a unique plate number (format: 2 letters, 3 numbers, 2 letters)
                $plateNumber = $faker->unique()->regexify('[A-Z]{2}[0-9]{3}[A-Z]{2}');

                $vehicle = new Vehicule();
                $vehicle->setOwnerName($randomClient->getAddress());
                $vehicle->setPlateNumber($plateNumber);
                $vehicle->setColor($faker->randomElement($colors));
                $vehicle->setMileage($faker->numberBetween(0, 200000));
                $vehicle->setVin($vin);
                $vehicle->setRegistrationDate($faker->dateTimeBetween('-10 years', 'now'));
                $vehicle->setClient($randomClient);
                $vehicle->setCarAPI($randomCarApi);

                $this->entityManager->persist($vehicle);

                if ($i % 10 === 0) {
                    $this->entityManager->flush();
                    $io->info(sprintf('Processed %d vehicles...', $i + 1));
                }
            }

            $this->entityManager->flush();
            $io->success(sprintf('Successfully seeded %d vehicles!', $numberOfVehicles));

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('An error occurred while seeding vehicles: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 