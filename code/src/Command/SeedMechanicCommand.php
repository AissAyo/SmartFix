<?php

namespace App\Command;

use App\Entity\Mechanic;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:seed-mechanics',
    description: 'Seed the database with fake mechanic data'
)]
class SeedMechanicCommand extends Command
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
            ->setDescription('Seed the database with fake mechanic data')
            ->setHelp('This command allows you to populate the mechanics table with fake data...')
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of mechanics to create', 100)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip if mechanics already exist');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create();
        $count = $input->getOption('count');
        $skipExisting = $input->getOption('skip-existing');

        $io->title('Seeding mechanics...');

        // Check if mechanics already exist
        $existingCount = $this->em->getRepository(Mechanic::class)->count([]);
        if ($existingCount > 0) {
            if ($skipExisting) {
                $io->note(sprintf('Found %d existing mechanics. Skipping as requested.', $existingCount));
                return Command::SUCCESS;
            } else {
                $io->warning(sprintf('Found %d existing mechanics. They will be kept.', $existingCount));
            }
        }

        // Possible specializations and certifications
        $specializations = [
            'Engine Specialist',
            'Transmission Expert',
            'Brake Systems',
            'Electrical Systems',
            'Diagnostics',
            'General Maintenance',
            'Performance Tuning',
            'Diesel Engines',
            'Hybrid/Electric Vehicles'
        ];

        $certificationOptions = [
            'ASE Certified',
            'EV Technician',
            'Brake Specialist',
            'AC Repair Certified',
            'Transmission Rebuilder',
            'Master Technician',
            'Diagnostic Specialist'
        ];

        $workingHoursOptions = [
            '08:00-17:00',
            '09:00-18:00',
            '10:00-19:00',
            '08:00-18:00',
            '09:00-19:00'
        ];
        $cities= [
            'Casablanca', 'Rabat', 'Marrakech', 'Fes', 'Tangier',
            'Agadir', 'Meknes', 'Oujda', 'Kenitra', 'Tetouan',
            'Safi', 'El Jadida', 'Nador', 'Beni Mellal', 'Khouribga',
            'Sidi Kacem', 'Laayoune', 'Dakhla', 'Errachidia', 'Taroudant',
            'Inezgane', 'Chefchaouen', 'Ksar el-Kebir', 'Berkane', 'Taza',
            'Midelt', 'Settat', 'Azilal', 'Ouarzazate', 'Mohammedia',
            'Larache', 'Tinghir', 'Al Hoceima', 'Moulay Yacoub', 'Messaoud',
            'Sidi Ifni', 'Skhirat', 'Tiznit', 'Jorf El Melha', 'El Aaiún',
            'Boujdour', 'Tata', 'Fkih Ben Salah', 'Khemisset', 'Tiznit',
            'Sidi Slimane', 'Tiflet', 'Fquih Ben Salah', 'Erfoud', 'Oulad Teima',
            'Souk Sebt', 'Lala Chafia', 'Moulay Idriss', 'Sefrou', 'Azrou',
            'Imilchil', 'Algeria', 'Boudnib', 'Bouskoura', 'Rissani', 'Meknès',
            'Essaouira', 'Oulad Ziane', 'Ait Ourir', 'Ait Melloul', 'Ben Ahmed',
            'Boudouaou', 'Sidi Moumen', 'Zaouiat Ahansal', 'Boujniba', 'Dcheira',
            'Berkane', 'Khouribga', 'Tiflet', 'Taza', 'Oued Zem', 'Essaouira'
        ];
        $city = $cities[array_rand($cities)];

        $io->progressStart($count);

        // Process in batches to avoid memory issues
        $batchSize = 100;
        $totalBatches = ceil($count / $batchSize);

        for ($batch = 0; $batch < $totalBatches; $batch++) {
            $currentBatchSize = min($batchSize, $count - ($batch * $batchSize));

            for ($i = 0; $i < $currentBatchSize; $i++) {
                // Generate Fake Data
                $name = $faker->name;
                $email = $faker->unique()->safeEmail;
                $address = $faker->address;
                $roles = 'MECHANIC'; // Default role
                $password = password_hash('password123', PASSWORD_BCRYPT); // Default password
                $resetToken = null;
                $tokenExpiration = null;
                $phone = $faker->phoneNumber;
                $photoProfil = "avatar5.png"; // Default avatar
                // Mechanic-specific properties
                $specialization = $faker->randomElement($specializations);
                $experienceYears = $faker->numberBetween(1, 30);

                // Generate certifications as a comma-separated string
                $numCerts = $faker->numberBetween(1, 3);
                $selectedCerts = [];
                for ($j = 0; $j < $numCerts; $j++) {
                    $cert = $faker->randomElement($certificationOptions);
                    if (!in_array($cert, $selectedCerts)) {
                        $selectedCerts[] = $cert;
                    }
                }
                $certifications = implode(', ', $selectedCerts);

                // Create Mechanic object with updated constructor parameters
                $mechanic = new Mechanic(
                    $name,
                    $email,
                    $address,
                    $roles,
                    $password,
                    $resetToken,
                    $tokenExpiration,
                    $phone,
                    $photoProfil,
                    $specialization,
                    $experienceYears,
                    $certifications
                );

                // Set additional properties that aren't in the constructor
                $mechanic->setPhotoProfil('avatar5.png');
                $mechanic->setCity($cities[array_rand($cities)]);
                $mechanic->setCertifications($certificationOptions[array_rand($certificationOptions)]);
                // Persist the mechanic entity
                $this->em->persist($mechanic);

                $io->progressAdvance();
            }

            // Flush after each batch
            $this->em->flush();
            $this->em->clear(Mechanic::class);

            $io->note(sprintf('Processed batch %d/%d', $batch + 1, $totalBatches));
        }

        $io->progressFinish();

        $io->success(sprintf('Successfully seeded %d mechanics!', $count));
        return Command::SUCCESS;
    }
}