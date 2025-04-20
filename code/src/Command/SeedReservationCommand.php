<?php

namespace App\Command;

use App\Entity\Reservation;
use App\Entity\Service;
use App\Entity\Vehicule;
use App\Entity\RepairPart;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'app:seed-reservations',
    description: 'Seeds the database with fake reservation data',
)]
class SeedReservationCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private \Faker\Generator $faker;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->faker = Factory::create();
    }

    protected function configure(): void
    {
        $this
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of reservations to create', 50)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip if reservations already exist');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Seeding Reservations...');

        // Check if we should skip existing
        if ($input->getOption('skip-existing')) {
            $existingCount = $this->entityManager->getRepository(Reservation::class)->count([]);
            if ($existingCount > 0) {
                $io->note('Reservations already exist. Skipping...');
                return Command::SUCCESS;
            }
        }

        // Get all vehicles with eager loading of both client and carAPI relationships
        $vehicles = $this->entityManager->createQueryBuilder()
            ->select('v', 'c', 'ca')
            ->from(Vehicule::class, 'v')
            ->innerJoin('v.client', 'c')
            ->innerJoin('v.carAPI', 'ca')
            ->getQuery()
            ->getResult();

        // Get all services with eager loading of category
        $services = $this->entityManager->createQueryBuilder()
            ->select('s', 'cs')
            ->from(Service::class, 's')
            ->innerJoin('s.categoryService', 'cs')
            ->getQuery()
            ->getResult();

        if (empty($vehicles) || empty($services)) {
            $io->error('No vehicles or services found in the database. Please seed vehicles and services first.');
            return Command::FAILURE;
        }

        // Define status distribution (weighted to be more realistic)
        $statuses = [
            'PENDING' => 20,      // 20% chance
            'CONFIRMED' => 25,    // 25% chance
            'IN_PROGRESS' => 15,  // 15% chance
            'COMPLETED' => 35,    // 35% chance
            'CANCELLED' => 5      // 5% chance
        ];

        // Create weighted status array for random selection
        $weightedStatuses = [];
        foreach ($statuses as $status => $weight) {
            for ($i = 0; $i < $weight; $i++) {
                $weightedStatuses[] = $status;
            }
        }

        $count = $input->getOption('count');
        $io->progressStart($count);

        for ($i = 0; $i < $count; $i++) {
            $reservation = new Reservation();
            
            // Set random vehicle and service
            $vehicle = $vehicles[array_rand($vehicles)];
            $service = $services[array_rand($services)];
            
            // Get random status
            $status = $this->faker->randomElement($weightedStatuses);
            
            // Set reservation date based on status
            $reservationDate = match($status) {
                'PENDING' => $this->faker->dateTimeBetween('now', '+30 days'),
                'CONFIRMED' => $this->faker->dateTimeBetween('now', '+14 days'),
                'IN_PROGRESS' => $this->faker->dateTimeBetween('-3 days', '+2 days'),
                'COMPLETED' => $this->faker->dateTimeBetween('-30 days', '-1 day'),
                'CANCELLED' => $this->faker->dateTimeBetween('-15 days', '+7 days'),
            };
            
            $reservation->setReservationDate($reservationDate);
            $reservation->setStatus($status);
            
            // Set estimated price based on service price plus potential parts
            $estimatedPrice = floatval($service->getPrice());
            if (in_array($status, ['IN_PROGRESS', 'COMPLETED'])) {
                // Add some repair parts for in-progress or completed reservations
                $numParts = $this->faker->numberBetween(1, 3);
                for ($j = 0; $j < $numParts; $j++) {
                    $part = new RepairPart();
                    $part->setPartName($this->faker->words(3, true));
                    $partPrice = $this->faker->randomFloat(2, 20, 200);
                    $part->setPrice((string)$partPrice);
                    $part->setReservation($reservation);
                    $estimatedPrice += $partPrice;
                    $this->entityManager->persist($part);
                }
            }
            
            $reservation->setEstimatedPrice((string)$estimatedPrice);
            $reservation->setVehicle($vehicle);
            $reservation->setService($service);
            
            // Add notes with higher probability for non-pending statuses
            $notesProbability = $status === 'PENDING' ? 0.3 : 0.8;
            if ($this->faker->boolean($notesProbability * 100)) {
                $notes = match($status) {
                    'PENDING' => $this->faker->randomElement([
                        'Customer requested urgent service',
                        'Preferred morning appointment',
                        'First-time customer',
                        'Special requirements noted'
                    ]),
                    'CONFIRMED' => $this->faker->randomElement([
                        'Appointment confirmed via phone',
                        'Customer will drop off keys at reception',
                        'Customer requested service updates via SMS',
                        'Vehicle history reviewed'
                    ]),
                    'IN_PROGRESS' => $this->faker->randomElement([
                        'Additional issues found during inspection',
                        'Waiting for parts delivery',
                        'Customer notified about progress',
                        'Estimated completion time updated'
                    ]),
                    'COMPLETED' => $this->faker->randomElement([
                        'Service completed as scheduled',
                        'Additional repairs approved and completed',
                        'Quality check passed',
                        'Customer satisfaction confirmed'
                    ]),
                    'CANCELLED' => $this->faker->randomElement([
                        'Customer requested cancellation',
                        'Rescheduled for next week',
                        'Emergency cancellation',
                        'Weather-related cancellation'
                    ]),
                };
                $reservation->setNotes($notes);
            }

            $this->entityManager->persist($reservation);

            // Flush every 10 reservations to manage memory
            if (($i + 1) % 10 === 0) {
                $this->entityManager->flush();
                
                // Clear the entity manager completely
                $this->entityManager->clear();
                
                // Refresh the vehicles and services arrays with eager loading
                $vehicles = $this->entityManager->createQueryBuilder()
                    ->select('v', 'c', 'ca')
                    ->from(Vehicule::class, 'v')
                    ->innerJoin('v.client', 'c')
                    ->innerJoin('v.carAPI', 'ca')
                    ->getQuery()
                    ->getResult();

                $services = $this->entityManager->createQueryBuilder()
                    ->select('s', 'cs')
                    ->from(Service::class, 's')
                    ->innerJoin('s.categoryService', 'cs')
                    ->getQuery()
                    ->getResult();
            }

            $io->progressAdvance();
        }

        $this->entityManager->flush();
        $io->progressFinish();

        $io->success(sprintf('Successfully seeded %d reservations!', $count));
        return Command::SUCCESS;
    }
} 