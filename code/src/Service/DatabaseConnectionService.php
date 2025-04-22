<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DatabaseConnectionService
{
    private LoggerInterface $logger;
    private ParameterBagInterface $params;
    private ?string $databaseHost = null;

    public function __construct(
        LoggerInterface $logger,
        ParameterBagInterface $params
    ) {
        $this->logger = $logger;
        $this->params = $params;
    }

    /**
     * Sets the database host
     */
    public function setDatabaseHost(string $host): void
    {
        $this->databaseHost = $host;
        $this->logger->info("Database host set to: {$host}");
    }

    /**
     * Determines the correct database host to use
     * Tries to connect to 'mysql' first, then falls back to '127.0.0.1'
     */
    public function getDatabaseHost(): string
    {
        if ($this->databaseHost !== null) {
            return $this->databaseHost;
        }

        // Try to connect to 'smartfix-mysql-1' first (Docker environment)
        if ($this->isHostReachable('smartfix-mysql-1', 3306)) {
            $this->logger->info('Using Docker MySQL host: smartfix-mysql-1');
            $this->databaseHost = 'smartfix-mysql-1';
            return $this->databaseHost;
        }

        // Fall back to local MySQL
        $this->logger->info('Using local MySQL host: 127.0.0.1');
        $this->databaseHost = '127.0.0.1';
        return $this->databaseHost;
    }

    /**
     * Checks if a host and port are reachable
     */
    private function isHostReachable(string $host, int $port, int $timeout = 1): bool
    {
        $this->logger->info("Testing connection to {$host}:{$port}");
        
        $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
        
        if (is_resource($connection)) {
            fclose($connection);
            return true;
        }
        
        $this->logger->warning("Could not connect to {$host}:{$port} - {$errstr} ({$errno})");
        return false;
    }
} 