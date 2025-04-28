<?php

namespace App\Command;

use App\Entity\Client;
use App\Entity\Vehicule;
use App\Entity\Service;
use App\Entity\CategoryService;
use App\Entity\Reservation;
use App\Entity\RepairPart;
use App\Entity\Conversation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:delete-all-data',
    description: 'Deletes all data from the database tables',
)]
class DeleteAllDataCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Deleting all data from tables...');

        try {
            // Delete in reverse order of dependencies
            $this->deleteAllData(RepairPart::class, $io);
            $this->deleteAllData(Reservation::class, $io);
            $this->deleteAllData(Service::class, $io);
            $this->deleteAllData(Vehicule::class, $io);
            $this->deleteAllData(Conversation::class, $io);
            $this->deleteAllData(Client::class, $io);
            $this->deleteAllData(CategoryService::class, $io);

            $io->success('All data has been successfully deleted from the tables.');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('An error occurred while deleting data: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function deleteAllData(string $entityClass, SymfonyStyle $io): void
    {
        $repository = $this->entityManager->getRepository($entityClass);
        $count = $repository->count([]);
        
        if ($count > 0) {
            $io->info("Deleting {$count} records from " . (new \ReflectionClass($entityClass))->getShortName());
            
            $qb = $this->entityManager->createQueryBuilder();
            $qb->delete($entityClass, 'e');
            $qb->getQuery()->execute();
            
            $this->entityManager->flush();
        } else {
            $io->info("No records found in " . (new \ReflectionClass($entityClass))->getShortName());
        }
    }
} 