<?php

namespace App\Command;

use App\Entity\CategoryService;
use App\Entity\Garage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;

#[AsCommand(
    name: 'app:seed-category-services',
    description: 'Seeds the database with category service data'
)]
class SeedCategoryServiceCommand extends Command
{
    protected static $defaultName = 'app:seed-category-services';
    protected static $defaultDescription = 'Seeds the database with category service data';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Average number of services per garage', 5)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip if category services already exist');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->section('Seeding category services...');

        try {
            // Check if we should skip existing
            if ($input->getOption('skip-existing')) {
                $existingCount = $this->entityManager->getRepository(CategoryService::class)->count([]);
                if ($existingCount > 0) {
                    $io->note('Category services already exist. Skipping...');
                    return Command::SUCCESS;
                }
            }

            // Get all available garages with eager loading of mechanics
            $garages = $this->entityManager->createQueryBuilder()
                ->select('g', 'm', 'l')
                ->from(Garage::class, 'g')
                ->leftJoin('g.mechanic', 'm')
                ->leftJoin('g.location', 'l')
                ->getQuery()
                ->getResult();

            if (empty($garages)) {
                $io->error('No garages found in the database. Please seed garages first.');
                return Command::FAILURE;
            }

            // Ensure all garages are properly persisted and flushed
            foreach ($garages as $garage) {
                $this->entityManager->persist($garage);
            }
            $this->entityManager->flush();
            $this->entityManager->clear();

            // Refresh garages after flush
            $garages = $this->entityManager->createQueryBuilder()
                ->select('g', 'm', 'l')
                ->from(Garage::class, 'g')
                ->leftJoin('g.mechanic', 'm')
                ->leftJoin('g.location', 'l')
                ->getQuery()
                ->getResult();

            $faker = Factory::create();
            $servicesPerGarage = (int)$input->getOption('count');
            $totalGarages = count($garages);

            // Define available service categories
            $serviceCategories = [
                'Oil Change Service',
                'Brake Service',
                'Tire Service',
                'Engine Diagnostics',
                'Transmission Service',
                'Battery Service',
                'Air Conditioning',
                'Wheel Alignment',
                'Exhaust System',
                'Electrical System',
                'Suspension Service',
                'Fuel System',
                'Cooling System',
                'Steering Service',
                'Body Repair',
                'Paint Service',
                'Interior Repair',
                'Glass Repair',
                'Detailing Service',
                'General Maintenance'
            ];

            // Calculate total progress steps
            $totalSteps = $totalGarages;
            $io->progressStart($totalSteps);

            // Process garages in smaller batches
            $batchSize = 10;
            foreach (array_chunk($garages, $batchSize) as $garageBatch) {
                foreach ($garageBatch as $garage) {
                    // Randomly select 3-7 services for each garage
                    $numServices = $faker->numberBetween(
                        max(3, $servicesPerGarage - 2),
                        min(7, $servicesPerGarage + 2)
                    );
                    
                    // Get random services without duplicates
                    $selectedServices = $faker->randomElements(
                        $serviceCategories,
                        $numServices
                    );

                    foreach ($selectedServices as $serviceName) {
                        $categoryService = new CategoryService();
                        $categoryService->setCategoryname($serviceName);
                        $categoryService->setGarage($garage);
                        $this->entityManager->persist($categoryService);
                    }

                    $io->progressAdvance();
                }

                // Flush after each batch
                $this->entityManager->flush();
                
                // Clear entity manager without detaching entities
                $this->entityManager->clear(CategoryService::class);
            }

            $io->progressFinish();
            $io->success('Successfully seeded category services for all garages!');
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $io->error('An error occurred while seeding category services: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 