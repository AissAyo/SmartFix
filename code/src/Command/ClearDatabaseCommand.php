<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:clear-database',
    description: 'Clears all tables in the database'
)]
class ClearDatabaseCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Clearing database...');

        try {
            // Disable foreign key checks
            $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS = 0');

            // Get all table names
            $tables = $this->entityManager->getConnection()->createSchemaManager()->listTableNames();

            // Clear each table
            foreach ($tables as $table) {
                $io->note(sprintf('Clearing table: %s', $table));
                $this->entityManager->getConnection()->executeQuery(sprintf('TRUNCATE TABLE %s', $table));
            }

            // Re-enable foreign key checks
            $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS = 1');

            $io->success('Database cleared successfully!');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error(sprintf('An error occurred while clearing the database: %s', $e->getMessage()));
            return Command::FAILURE;
        }
    }
} 