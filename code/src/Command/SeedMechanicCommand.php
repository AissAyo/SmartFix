<?php

namespace App\Command;

use App\Entity\Mechanic;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
            ->setHelp('This command allows you to populate the mechanics table with fake data...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();

        $output->writeln('Seeding mechanics...');

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

        for ($i = 0; $i < 50; $i++) {
            // Generate Fake Data
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;
            $roles = "ROLE_MECHANIC"; // Default role
            $password = password_hash('password123', PASSWORD_BCRYPT); // Default password
            $resetToken = null;
            $tokenExpiration = null;
            $phoneNumber = $faker->phoneNumber;
            $logo = $faker->imageUrl(200, 200, 'business'); // Generates a fake logo URL
            $workingHours = $faker->randomElement(['08:00-17:00', '09:00-18:00', '10:00-19:00']);

            // Mechanic-specific properties
            $specialization = $faker->randomElement($specializations);
            $experienceYears = $faker->numberBetween(1, 30);

            // Generate 1-3 random certifications
            $certifications = [];
            $numCerts = $faker->numberBetween(1, 3);
            for ($j = 0; $j < $numCerts; $j++) {
                $cert = $faker->randomElement($certificationOptions);
                if (!in_array($cert, $certifications)) {
                    $certifications[] = $cert;
                }
            }

            // Create Mechanic object
            $mechanic = new Mechanic(
                $name,
                $email,
                $roles,
                $password,
                $resetToken,
                $tokenExpiration,
                $phoneNumber,
                $logo,
                $workingHours,
                $specialization,
                $experienceYears,
                $certifications
            );

            // Persist the mechanic entity
            $this->em->persist($mechanic);
        }

        // Flush to save all generated entities to the database
        $this->em->flush();

        $output->writeln('Seeding completed!');

        return Command::SUCCESS;
    }
}