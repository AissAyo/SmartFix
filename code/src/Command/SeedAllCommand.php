<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Console\Helper\ProgressBar;

#[AsCommand(
    name: 'app:seed-all',
    description: 'Runs all seed commands in the correct order to prepare the database for testing'
)]
class SeedAllCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of clients and mechanics to generate', 100)
            ->addOption('skip-existing', 's', InputOption::VALUE_NONE, 'Skip seeding if data already exists')
            ->addOption('clear', null, InputOption::VALUE_NONE, 'Clear the database before seeding');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = $input->getOption('count');
        $skipExisting = $input->getOption('skip-existing');
        $shouldClear = $input->getOption('clear');

        $io->title('Starting database seeding process...');

        // Clear database if requested
        if ($shouldClear) {
            $io->section('Clearing database...');
            $this->runCommand('doctrine:schema:drop --force', $io);
            $this->runCommand('doctrine:schema:create', $io);
        }

        // Check if data exists
        if ($skipExisting && $this->dataExists()) {
            $io->warning('Data already exists. Skipping seeding.');
            return Command::SUCCESS;
        }

        $progressBar = $io->createProgressBar(8);
        $progressBar->start();

        try {
            // 1. Seed car data first using local predefined makes
            $io->section('Seeding car data...');
            $this->runCommand('app:car --fetch --use-local --count=' . (50), $io);
            $progressBar->advance();

            // 2. Seed locations
            $io->section('Seeding locations...');
            $this->runCommand("app:seed-locations --count=" . ($count * 2), $io);
            $progressBar->advance();
            
            // 3. Generate clients and mechanics
            $io->section('Generating clients and mechanics...');
            $this->runCommand("app:seed-clients --count={$count}", $io);
            $this->runCommand("app:seed-mechanics --count={$count}", $io);
            $progressBar->advance();

            // 4. Seed vehicles
            $io->section('Seeding vehicles...');
            $this->runCommand("app:seed-vehicles --count=" . ($count * 2), $io);
            $progressBar->advance();

            // 5. Seed garages
            $io->section('Seeding garages...');
            $this->runCommand("app:seed-garages --count=" . ($count * 2), $io);
            $progressBar->advance();

            // 6. Seed category services
            $io->section('Seeding category services...');
            $this->runCommand('app:seed-category-services --count=20', $io);
            $progressBar->advance();

            // 7. Seed services
            $io->section('Seeding services...');
            $this->runCommand('app:seed-services --count=50', $io);
            $progressBar->advance();

            // 8. Finally, seed reservations
            $io->section('Seeding reservations...');
            $this->runCommand('app:seed-reservations --count=100', $io);
            $progressBar->advance();

            $progressBar->finish();
            $io->newLine(2);
            $io->success('Database seeding completed successfully!');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('An error occurred during seeding: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function runCommand(string $command, SymfonyStyle $io): void
    {
        $process = Process::fromShellCommandline('php bin/console ' . $command);
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) use ($io) {
            if (Process::ERR === $type) {
                $io->error($buffer);
            } else {
                $io->text($buffer);
            }
        });

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    private function dataExists(): bool
    {
        // Check if any data exists in the database
        $process = Process::fromShellCommandline('php bin/console doctrine:query:sql "SELECT COUNT(*) FROM clients"');
        $process->run();
        return (int)$process->getOutput() > 0;
    }
} 