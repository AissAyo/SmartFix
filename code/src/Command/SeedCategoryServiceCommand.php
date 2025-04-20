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
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of category services to create', 100)
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

            $faker = Factory::create();
            $count = (int)$input->getOption('count');
            $batchSize = 100;

            $io->progressStart($count);

            for ($i = 0; $i < $count; $i++) {
                $categoryService = new CategoryService();
                $categoryService->setCategoryname($faker->unique()->randomElement([
                    'Oil Change',
                    'Brake Service',
                    'Tire Rotation',
                    'Engine Tune-up',
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
                    'Diagnostic Service',
                    'Body Repair',
                    'Paint Service',
                    'Interior Repair',
                    'Glass Repair',
                    'Detailing Service'
                ]));

                $this->entityManager->persist($categoryService);

                if (($i + 1) % $batchSize === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear(CategoryService::class);
                }

                $io->progressAdvance();
            }

            $this->entityManager->flush();
            $io->progressFinish();

            $io->success(sprintf('Successfully seeded %d category services!', $count));
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $io->error('An error occurred while seeding category services: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 