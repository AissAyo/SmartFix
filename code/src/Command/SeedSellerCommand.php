<?php

namespace App\Command;

use App\Entity\Seller;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:seed-sellers',
    description: 'Seed the database with fake seller data'
)]
class SeedSellerCommand extends Command
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();

        $output->writeln('Seeding sellers...');

        $cities = [
            'Casablanca', 'Rabat', 'Fès', 'Marrakech', 'Tangier', 'Agadir', 'Meknès',
            'Oujda', 'Tétouan', 'Safi', 'Mohammedia', 'El Jadida', 'Béni Mellal', 'Nador',
            'Khouribga', 'Kénitra', 'Laâyoune', 'Errachidia', 'Taroudant', 'Taza',
        ];

        for ($i = 0; $i < 100; $i++) {
            // Generate Fake Data
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;
            $contactInfo = $faker->address;
            $roles = ["Seller"]; // Default role
            $password = password_hash('password123', PASSWORD_BCRYPT); // Default password
            $resetToken = null;
            $tokenExpiration = null;
            $phoneNumber = $faker->phoneNumber;
            $logo = $faker->imageUrl(200, 200, 'business'); // Generates a fake logo URL
            $workingHours = $faker->randomElement(['08:00-17:00', '09:00-18:00', '10:00-19:00']);
            $city = $faker->randomElement($cities);

            // Create Seller object (inherits from User)
            $seller = new Seller(
                $name,
                $email,
                $city,
                'Seller', // Role set as 'Seller'
                $password,
                $resetToken,
                $tokenExpiration,
                $phoneNumber,
                $logo,
                $workingHours,
                $city
            );

            // Persist the seller entity
            $this->em->persist($seller);
        }

        // Flush to save all generated entities to the database
        $this->em->flush();

        $output->writeln('Seeding completed!');

        return Command::SUCCESS;
    }
}
