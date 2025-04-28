<?php

namespace App\Command;

use App\Entity\CategoryService;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'app:seed-services',
    description: 'Seeds the database with fake service data'
)]
class SeedServiceCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of services to create', 50)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip if services already exist');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->section('Seeding services...');

        try {
            // Check if we should skip existing
            if ($input->getOption('skip-existing')) {
                $existingCount = $this->entityManager->getRepository(Service::class)->count([]);
                if ($existingCount > 0) {
                    $io->note('Services already exist. Skipping...');
                    return Command::SUCCESS;
                }
            }

            // Get all category services with eager loading of garages
            $categoryServices = $this->entityManager->createQueryBuilder()
                ->select('cs', 'g')
                ->from(CategoryService::class, 'cs')
                ->leftJoin('cs.garage', 'g')
                ->getQuery()
                ->getResult();

            if (empty($categoryServices)) {
                $io->error('No category services found. Please run app:seed-category-services first.');
                return Command::FAILURE;
            }

            // Ensure all category services and their garages are properly persisted
            foreach ($categoryServices as $categoryService) {
                $this->entityManager->persist($categoryService);
                if ($categoryService->getGarage()) {
                    $this->entityManager->persist($categoryService->getGarage());
                }
            }
            $this->entityManager->flush();
            $this->entityManager->clear();

            // Refresh category services after flush
            $categoryServices = $this->entityManager->createQueryBuilder()
                ->select('cs', 'g')
                ->from(CategoryService::class, 'cs')
                ->leftJoin('cs.garage', 'g')
                ->getQuery()
                ->getResult();

            $faker = Factory::create();
            $servicesToCreate = (int)$input->getOption('count');
            $statuses = ['active', 'inactive'];
            
            $io->progressStart($servicesToCreate);

            for ($i = 0; $i < $servicesToCreate; $i++) {
                $service = new Service();
                
                // Set service name
                $service->setName($faker->words(3, true));
                
                // Set description
                $service->setDescription($faker->paragraph(2));
                
                // Set random price (between 20 and 500)
                $price = $faker->randomFloat(2, 20, 500);
                $service->setPrice($price);
                
                // Set status
                $service->setStatus($faker->randomElement($statuses));
                
                // Assign random category service
                $randomCategory = $categoryServices[array_rand($categoryServices)];
                $service->setCategoryService($randomCategory);
                
                $this->entityManager->persist($service);
                
                if (($i + 1) % 10 === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear(Service::class);
                    
                    // Refresh category services after each batch
                    $categoryServices = $this->entityManager->createQueryBuilder()
                        ->select('cs', 'g')
                        ->from(CategoryService::class, 'cs')
                        ->leftJoin('cs.garage', 'g')
                        ->getQuery()
                        ->getResult();
                }
                
                $io->progressAdvance();
            }

            $this->entityManager->flush();
            $io->progressFinish();

            $io->success(sprintf('Successfully seeded %d services!', $servicesToCreate));
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $io->error('An error occurred while seeding services: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
