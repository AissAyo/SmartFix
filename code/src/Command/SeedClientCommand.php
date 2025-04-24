<?php

namespace App\Command;

use App\Entity\Client;
use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:seed-clients',
    description: 'Seed the database with fake client data'
)]
class SeedClientCommand extends Command
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Seed the database with fake client data')
            ->setHelp('This command allows you to populate the clients table with fake data...')
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of clients to create', 2000)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip if clients already exist');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create();
        $count = $input->getOption('count');
        $skipExisting = $input->getOption('skip-existing');
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
        $io->title('Seeding clients...');

        // Check if clients already exist
        $existingCount = $this->em->getRepository(Client::class)->count([]);
        if ($existingCount > 0) {
            if ($skipExisting) {
                $io->note(sprintf('Found %d existing clients. Skipping as requested.', $existingCount));
                return Command::SUCCESS;
            } else {
                $io->warning(sprintf('Found %d existing clients. They will be kept.', $existingCount));
            }
        }

        // Get available locations that are not already assigned to clients
        $qb = $this->em->createQueryBuilder();
        $qb->select('l')
            ->from(Location::class, 'l')
            ->leftJoin('l.client', 'c')
            ->where('c.id IS NULL');

        $availableLocations = $qb->getQuery()->getResult();

        if (empty($availableLocations)) {
            $io->error('No available locations found. Please run app:seed-locations first.');
            return Command::FAILURE;
        }

        // Shuffle the locations array to randomize the assignment
        shuffle($availableLocations);

        if (count($availableLocations) < $count) {
            $io->warning(sprintf('Only %d locations available. Will create %d clients instead of %d.',
                count($availableLocations), count($availableLocations), $count));
            $count = count($availableLocations);
        }

        $io->progressStart($count);

        // Process in batches to avoid memory issues
        $batchSize = 100;
        $totalBatches = ceil($count / $batchSize);
        $locationIndex = 0;

        for ($batch = 0; $batch < $totalBatches; $batch++) {
            $currentBatchSize = min($batchSize, $count - ($batch * $batchSize));

            for ($i = 0; $i < $currentBatchSize; $i++) {
                if ($locationIndex >= count($availableLocations)) {
                    $io->warning('Ran out of available locations. Stopping client creation.');
                    break 2;
                }

                $client = new Client();

                // Set basic client information
                $client->setName($faker->name());
                $client->setEmail($faker->unique()->safeEmail());
                $client->setPhone($faker->phoneNumber());
                $client->setPassword($this->passwordHasher->hashPassword($client, 'password123'));
                $client->setRoles("CLIENT");

                $client->setVerificationStatus($faker->boolean(70) // 70% chance true, 30% false
                );
                $client->setLoyaltyPoints($faker->numberBetween(0, 1000));
                $client->setDateInscription(new \DateTimeImmutable());
                $client->setCity($cities[array_rand($cities)]);                // Set a random address
                $client->setPhotoProfil('avatar5.png');

                $client->setAddress($faker->streetAddress());

                // Set the next available location
                $client->setLocation($availableLocations[$locationIndex++]);

                // Persist the client
                $this->em->persist($client);

                $io->progressAdvance();
            }

            // Flush after each batch
            $this->em->flush();
            $this->em->clear(Client::class);

            $io->note(sprintf('Processed batch %d/%d', $batch + 1, $totalBatches));
        }

        $io->progressFinish();

        $io->success(sprintf('Successfully seeded %d clients!', $locationIndex));
        return Command::SUCCESS;
    }
}