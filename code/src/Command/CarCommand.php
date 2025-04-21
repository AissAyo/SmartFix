<?php

namespace App\Command;

use App\Service\CarApiService;
use App\Entity\CarAPI;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'app:car',
    description: 'Manages car data operations including fetching and storing from CarAPI',
)]
class CarCommand extends Command
{
    // Predefined list of common car makes by country
    private const COMMON_CAR_MAKES = [
        'German' => [
            'BMW', 'Mercedes-Benz', 'Audi', 'Volkswagen', 'Porsche', 
            'Opel', 'Smart', 'Maybach', 'Alpina', 'Wartburg'
        ],
        'Japanese' => [
            'Toyota', 'Honda', 'Nissan', 'Mazda', 'Subaru', 
            'Mitsubishi', 'Suzuki', 'Lexus', 'Infiniti', 'Acura',
            'Daihatsu', 'Isuzu', 'Scion', 'Mitsubishi', 'Hino'
        ],
        'French' => [
            'Renault', 'Peugeot', 'Citroën', 'Alpine', 'Bugatti',
            'DS Automobiles', 'Venturi', 'Delage', 'PGO', 'Aixam'
        ],
        'American' => [
            'Ford', 'Chevrolet', 'Dodge', 'Jeep', 'Chrysler',
            'Buick', 'Cadillac', 'Lincoln', 'Tesla', 'Pontiac',
            'Plymouth', 'Oldsmobile', 'Saturn', 'Hummer', 'Scion'
        ]
    ];

    public function __construct(
        private CarApiService $carApiService,
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                'fetch',
                'f',
                InputOption::VALUE_NONE,
                'Fetch car data from the API'
            )
            ->addOption(
                'count',
                'c',
                InputOption::VALUE_OPTIONAL,
                'Number of car makes to fetch (default: 50)',
                50
            )
            ->addOption(
                'clear',
                null,
                InputOption::VALUE_NONE,
                'Clear existing car data before fetching'
            )
            ->addOption(
                'retry',
                'r',
                InputOption::VALUE_OPTIONAL,
                'Number of retry attempts for failed API calls',
                3
            )
            ->addOption(
                'delay',
                'd',
                InputOption::VALUE_OPTIONAL,
                'Delay in seconds between API calls',
                1
            )
            ->addOption(
                'use-local',
                'l',
                InputOption::VALUE_NONE,
                'Use local predefined car makes instead of API'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        // Get options
        $shouldFetch = $input->getOption('fetch');
        $count = (int) $input->getOption('count');
        $shouldClear = $input->getOption('clear');
        $retryAttempts = (int) $input->getOption('retry');
        $delay = (int) $input->getOption('delay');
        $useLocal = $input->getOption('use-local');

        try {
            if (!$shouldFetch) {
                $io->error('Please specify at least one operation (--fetch)');
                return Command::FAILURE;
            }

            if ($shouldClear) {
                $io->info('Clearing existing car data...');
                $this->clearExistingData();
                $io->success('Successfully cleared existing car data.');
            }

            if ($shouldFetch) {
                if ($useLocal) {
                    $io->info('Using local predefined car makes instead of API...');
                    $this->seedLocalCarMakes($count);
                    $io->success(sprintf('Successfully seeded %d car makes from local data', $count));
                } else {
                    $io->info(sprintf(
                        'Starting to fetch car data from CarAPI (limit: %d, retry attempts: %d, delay: %ds)...',
                        $count,
                        $retryAttempts,
                        $delay
                    ));
                    
                    $this->fetchAndStoreCarData($count, $retryAttempts, $delay);
                    
                    $io->success(sprintf('Successfully fetched and stored %d car makes from CarAPI', $count));
                }
            }

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('Failed to execute car command: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function clearExistingData(): void
    {
        try {
            $this->entityManager->createQuery('DELETE FROM App\Entity\CarAPI c')->execute();
            $this->entityManager->flush();
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to clear existing car data: ' . $e->getMessage());
        }
    }

    private function fetchAndStoreCarData(int $limit, int $retryAttempts, int $delay): void
    {
        try {
            // Add initial delay before first request
            sleep($delay);

            // Fetch makes
            $makes = $this->carApiService->getMakes(1, $limit);
            
            if (empty($makes)) {
                throw new \RuntimeException('No car makes found in the API response');
            }

            foreach ($makes as $makeData) {
                try {
                    // Add delay between make requests
                    sleep($delay);

                    // Create a new CarAPI entity for this make
                    $carApi = new CarAPI();
                    $carApi->setMake($makeData['name'] ?? 'Unknown');
                    $carApi->setModel(''); // Will be updated when processing models
                    $carApi->setYear(0); // Will be updated when processing years

                    $this->entityManager->persist($carApi);
                    $this->entityManager->flush();

                    // Fetch models for this make
                    if (isset($makeData['id'])) {
                        // Add delay before model requests
                        sleep($delay);
                        
                        $models = $this->carApiService->getModels($makeData['id']);
                        
                        if (!empty($models)) {
                            foreach ($models as $modelData) {
                                $modelCarApi = new CarAPI();
                                $modelCarApi->setMake($makeData['name']);
                                $modelCarApi->setModel($modelData['name'] ?? 'Unknown');
                                $modelCarApi->setYear(0); // Will be updated when processing years

                                $this->entityManager->persist($modelCarApi);
                            }
                            $this->entityManager->flush();
                        }
                    }
                } catch (\Exception $e) {
                    // Log error but continue with next make
                    $this->getApplication()->getLogger()->error(
                        "Error processing make {$makeData['name']}: " . $e->getMessage()
                    );
                    continue;
                }
            }
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to fetch and store car data: ' . $e->getMessage());
        }
    }

    private function seedLocalCarMakes(int $limit): void
    {
        try {
            $allMakes = [];
            foreach (self::COMMON_CAR_MAKES as $country => $makes) {
                $allMakes = array_merge($allMakes, $makes);
            }

            $commonModels = [
                'Sedan', 'SUV', 'Hatchback', 'Coupe', 'Wagon', 
                'Truck', 'Van', 'Minivan', 'Convertible', 'Crossover'
            ];

            $commonYears = [2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023];

            // Calculate how many makes we need based on the limit
            $makesNeeded = min(count($allMakes), ceil($limit / 2)); // Each make will get 2 models
            $selectedMakes = array_slice($allMakes, 0, $makesNeeded);
            
            $carsCreated = 0;
            foreach ($selectedMakes as $make) {
                if ($carsCreated >= $limit) {
                    break;
                }

                // Create a make entry
                $carApi = new CarAPI();
                $carApi->setMake($make);
                $carApi->setModel('');
                $carApi->setYear(0);
                $this->entityManager->persist($carApi);
                $carsCreated++;

                // Create exactly 2 models for each make
                for ($i = 0; $i < 2; $i++) {
                    if ($carsCreated >= $limit) {
                        break;
                    }

                    $modelCarApi = new CarAPI();
                    $modelCarApi->setMake($make);
                    $modelCarApi->setModel($commonModels[array_rand($commonModels)]);
                    $modelCarApi->setYear($commonYears[array_rand($commonYears)]);
                    
                    // Add some random attributes
                    $modelCarApi->setTransmission(rand(0, 1) ? 'Automatic' : 'Manual');
                    $modelCarApi->setDrivetrain(rand(0, 1) ? 'FWD' : 'AWD');
                    $modelCarApi->setFuelType(rand(0, 1) ? 'Gasoline' : 'Diesel');
                    $modelCarApi->setBodyType($commonModels[array_rand($commonModels)]);
                    
                    $this->entityManager->persist($modelCarApi);
                    $carsCreated++;
                }
            }

            $this->entityManager->flush();
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to seed local car makes: ' . $e->getMessage());
        }
    }
} 