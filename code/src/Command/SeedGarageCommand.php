<?php

namespace App\Command;

use App\Entity\Garage;
use App\Entity\Location;
use App\Entity\Mechanic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'app:seed-garages',
    description: 'Seeds the database with fake garage data'
)]
class SeedGarageCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of garages to create', 50)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip if garages already exist');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->section('Seeding garages...');

        try {
            // Check if we should skip existing
            if ($input->getOption('skip-existing')) {
                $existingCount = $this->entityManager->getRepository(Garage::class)->count([]);
                if ($existingCount > 0) {
                    $io->note('Garages already exist. Skipping...');
                    return Command::SUCCESS;
                }
            }

            // Get all mechanics
            $mechanics = $this->entityManager->getRepository(Mechanic::class)->findAll();
            if (empty($mechanics)) {
                $io->error('No mechanics found. Please run app:seed-mechanics first.');
                return Command::FAILURE;
            }

            // Get available locations (those without garages)
            $qb = $this->entityManager->createQueryBuilder();
            $qb->select('l')
               ->from(Location::class, 'l')
               ->leftJoin('App\Entity\Garage', 'g', 'WITH', 'g.location = l')
               ->where('g.id IS NULL');
            
            $availableLocations = $qb->getQuery()->getResult();
            
            if (empty($availableLocations)) {
                $io->error('No available locations found. Please run app:seed-locations first.');
                return Command::FAILURE;
            }

            $faker = Factory::create();
            $count = min((int)$input->getOption('count'), count($availableLocations));
            $batchSize = 100;

            // Shuffle available locations to randomize assignment
            shuffle($availableLocations);
            $locationIndex = 0;

            $io->progressStart($count);

            for ($i = 0; $i < $count; $i++) {
                $garage = new Garage();
                $garage->setEmailGarage($faker->email());
                $garage->setGarageAddress($faker->streetAddress());
                $garage->setRating($faker->randomFloat(1, 0, 5));
                $garage->setStatus('active');
                $garage->setName($faker->company());
                $garage->setWorkingHours('8AM-5PM');
                $garage->setPhoneNumber($faker->phoneNumber());
                $garage->setCity($faker->city());
                
                // Assign a random mechanic
                $randomMechanic = $mechanics[array_rand($mechanics)];
                $garage->setMechanic($randomMechanic);
                
                // Find next available location
                while ($locationIndex < count($availableLocations)) {
                    $location = $availableLocations[$locationIndex];
                    if ($location->getGarage() === null) {
                        $garage->setLocation($location);
                        $location->setGarage($garage);
                        $locationIndex++;
                        break;
                    }
                    $locationIndex++;
                }

                // If we couldn't find an available location, break the loop
                if ($garage->getLocation() === null) {
                    $io->warning(sprintf('Only created %d garages due to running out of available locations', $i));
                    break;
                }

                $this->entityManager->persist($garage);
                
                if (($i + 1) % $batchSize === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear(Garage::class);
                    
                    // Refresh available locations after clear
                    $availableLocations = $qb->getQuery()->getResult();
                }
                
                $io->progressAdvance();
            }

            $this->entityManager->flush();
            $io->progressFinish();

            $io->success(sprintf('Successfully seeded %d garages!', $i));
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $io->error('An error occurred while seeding garages: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 