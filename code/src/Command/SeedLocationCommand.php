<?php

namespace App\Command;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:seed-locations',
    description: 'Seed the database with fake location data'
)]
class SeedLocationCommand extends Command
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
            ->setDescription('Seed the database with fake location data')
            ->setHelp('This command allows you to populate the locations table with fake data...')
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of locations to create', 2000)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip if locations already exist');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create();
        $count = $input->getOption('count');
        $skipExisting = $input->getOption('skip-existing');

        $io->title('Seeding locations...');

        // Check if locations already exist
        $existingCount = $this->em->getRepository(Location::class)->count([]);
        if ($existingCount > 0) {
            if ($skipExisting) {
                $io->note(sprintf('Found %d existing locations. Skipping as requested.', $existingCount));
                return Command::SUCCESS;
            } else {
                $io->warning(sprintf('Found %d existing locations. They will be kept.', $existingCount));
            }
        }

        $io->progressStart($count);

        // Morocco cities and their approximate coordinates
        $moroccoCities = [
            ['name' => 'Casablanca', 'lat' => 33.5731, 'lng' => -7.5898],
            ['name' => 'Rabat', 'lat' => 34.0209, 'lng' => -6.8416],
            ['name' => 'Marrakech', 'lat' => 31.6295, 'lng' => -7.9811],
            ['name' => 'Fes', 'lat' => 34.0181, 'lng' => -5.0078],
            ['name' => 'Tangier', 'lat' => 35.7595, 'lng' => -5.8340],
            ['name' => 'Agadir', 'lat' => 30.4278, 'lng' => -9.5981],
            ['name' => 'Meknes', 'lat' => 33.8951, 'lng' => -5.5547],
            ['name' => 'Oujda', 'lat' => 34.6867, 'lng' => -1.9114],
            ['name' => 'Kenitra', 'lat' => 34.2610, 'lng' => -6.5802],
            ['name' => 'Tetouan', 'lat' => 35.5762, 'lng' => -5.3684],
            ['name' => 'Nador', 'lat' => 35.1688, 'lng' => -2.9278],
            ['name' => 'El Jadida', 'lat' => 33.2316, 'lng' => -8.5004],
            ['name' => 'Taza', 'lat' => 34.2144, 'lng' => -4.0088],
            ['name' => 'Settat', 'lat' => 33.0012, 'lng' => -7.6168],
            ['name' => 'Larache', 'lat' => 35.1878, 'lng' => -6.1556],
            ['name' => 'Khouribga', 'lat' => 32.8848, 'lng' => -6.9064],
            ['name' => 'Ouarzazate', 'lat' => 30.9333, 'lng' => -6.9167],
            ['name' => 'Béni Mellal', 'lat' => 32.3373, 'lng' => -6.3498],
            ['name' => 'Tétouan', 'lat' => 35.5762, 'lng' => -5.3684]
        ];

        // Morocco postal codes by city
        $postalCodes = [
            'Casablanca' => ['20000', '20001', '20002', '20003', '20004', '20005', '20006', '20007', '20008', '20009'],
            'Rabat' => ['10000', '10001', '10002', '10003', '10004', '10005', '10006', '10007', '10008', '10009'],
            'Marrakech' => ['40000', '40001', '40002', '40003', '40004', '40005', '40006', '40007', '40008', '40009'],
            'Fes' => ['30000', '30001', '30002', '30003', '30004', '30005', '30006', '30007', '30008', '30009'],
            'Tangier' => ['90000', '90001', '90002', '90003', '90004', '90005', '90006', '90007', '90008', '90009'],
            'Agadir' => ['80000', '80001', '80002', '80003', '80004', '80005', '80006', '80007', '80008', '80009'],
            'Meknes' => ['50000', '50001', '50002', '50003', '50004', '50005', '50006', '50007', '50008', '50009'],
            'Oujda' => ['60000', '60001', '60002', '60003', '60004', '60005', '60006', '60007', '60008', '60009'],
            'Kenitra' => ['14000', '14001', '14002', '14003', '14004', '14005', '14006', '14007', '14008', '14009'],
            'Tetouan' => ['93000', '93001', '93002', '93003', '93004', '93005', '93006', '93007', '93008', '93009'],
            'Nador' => ['62000', '62001', '62002', '62003', '62004', '62005', '62006', '62007', '62008', '62009'],
            'El Jadida' => ['24000', '24001', '24002', '24003', '24004', '24005', '24006', '24007', '24008', '24009'],
            'Taza' => ['35000', '35001', '35002', '35003', '35004', '35005', '35006', '35007', '35008', '35009'],
            'Settat' => ['26000', '26001', '26002', '26003', '26004', '26005', '26006', '26007', '26008', '26009'],
            'Larache' => ['92000', '92001', '92002', '92003', '92004', '92005', '92006', '92007', '92008', '92009'],
            'Khouribga' => ['25000', '25001', '25002', '25003', '25004', '25005', '25006', '25007', '25008', '25009'],
            'Ouarzazate' => ['45000', '45001', '45002', '45003', '45004', '45005', '45006', '45007', '45008', '45009'],
            'Béni Mellal' => ['23000', '23001', '23002', '23003', '23004', '23005', '23006', '23007', '23008', '23009'],
            'Tétouan' => ['93000', '93001', '93002', '93003', '93004', '93005', '93006', '93007', '93008', '93009']
        ];

        // Process in batches to avoid memory issues
        $batchSize = 100;
        $totalBatches = ceil($count / $batchSize);
        
        for ($batch = 0; $batch < $totalBatches; $batch++) {
            $currentBatchSize = min($batchSize, $count - ($batch * $batchSize));
            
            for ($i = 0; $i < $currentBatchSize; $i++) {
                $location = new Location();
                
                // Select a random city
                $city = $moroccoCities[array_rand($moroccoCities)];
                
                // Generate coordinates within a small radius of the city center (±0.1 degrees)
                $latitude = $city['lat'] + ($faker->randomFloat(4, -0.1, 0.1));
                $longitude = $city['lng'] + ($faker->randomFloat(4, -0.1, 0.1));
                
                $location->setLatitude($latitude);
                $location->setLongitude($longitude);
                $location->setAddress($faker->address());
                $location->setCity($city['name']);
                $location->setCountry('Morocco');
                $location->setPostalCode($faker->randomElement($postalCodes[$city['name']]));

                // Persist the location
                $this->em->persist($location);
                
                $io->progressAdvance();
            }
            
            // Flush after each batch
            $this->em->flush();
            $this->em->clear(Location::class);
            
            $io->note(sprintf('Processed batch %d/%d', $batch + 1, $totalBatches));
        }

        $io->progressFinish();

        $io->success(sprintf('Successfully seeded %d locations!', $count));
        return Command::SUCCESS;
    }
}   