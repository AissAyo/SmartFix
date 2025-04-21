<?php

namespace App\Command;

use App\Service\CarApiService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'app:fetch-car-api',
    description: 'Fetches and stores car data from the CarAPI',
)]
class FetchCarAPICommand extends Command
{
    public function __construct(
        private CarApiService $carApiService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'count',
            'c',
            InputOption::VALUE_OPTIONAL,
            'Number of car makes to fetch (default: 50)',
            50
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = (int) $input->getOption('count');

        try {
            $io->info(sprintf('Starting to fetch car data from CarAPI (limit: %d)...', $count));
            
            $this->carApiService->fetchAndStoreCarData($count);
            
            $io->success(sprintf('Successfully fetched and stored %d car makes from CarAPI', $count));
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('Failed to fetch car data: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 