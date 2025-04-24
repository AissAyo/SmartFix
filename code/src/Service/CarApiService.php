<?php
namespace App\Service;

use App\Entity\CarAPI;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\Query\QueryException;
use App\Service\DatabaseConnectionService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

class CarApiService
{
    private LoggerInterface $logger;
    private DatabaseConnectionService $databaseService;
    private string $baseUrl;
    private Client $client;
    private string $apiKey;
    private string $apiSecret;
    private EntityManagerInterface $em;
    private ?string $jwt = null;

    public function __construct(
        Client $client,
        LoggerInterface $logger,
        DatabaseConnectionService $databaseService,
        EntityManagerInterface $em,
        string $apiKey,
        string $apiSecret,
        string $baseUrl
    ) {
        $this->client = $client;
        $this->logger = $logger;
        $this->databaseService = $databaseService;
        $this->em = $em;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Authenticate with the CarAPI using JWT
     */
    private function authenticate(): void
    {
        try {
            $this->logger->info('Attempting to authenticate with CarAPI');

            $response = $this->client->request('POST', $this->baseUrl . '/api/auth/login', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => [
                    'api_token' => $this->apiKey,
                    'api_secret' => $this->apiSecret
                ]
            ]);

            if ($response->getStatusCode() === Response::HTTP_OK) {
                $this->jwt = $response->getBody()->getContents();
                $this->logger->info('Successfully authenticated with CarAPI');
            } else {
                throw new \RuntimeException('Authentication failed with status code: ' . $response->getStatusCode());
            }
        } catch (GuzzleException $e) {
            $this->logger->error('Authentication failed', [
                'error' => $e->getMessage(),
                'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null
            ]);
            throw new \RuntimeException('Failed to authenticate with CarAPI: ' . $e->getMessage());
        }
    }

    /**
     * Make an authenticated request to the CarAPI
     */
    private function makeRequest(string $method, string $endpoint, array $options = []): array
    {
        if (!$this->jwt) {
            $this->authenticate();
        }

        $maxRetries = 5;
        $retryCount = 0;
        $baseDelay = 1;

        while ($retryCount < $maxRetries) {
            try {
                $response = $this->client->request($method, $this->baseUrl . $endpoint, array_merge([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->jwt,
                        'Accept' => 'application/json'
                    ]
                ], $options));

                $statusCode = $response->getStatusCode();
                $this->logger->info("API request to {$endpoint} returned status code: {$statusCode}");

                if ($statusCode === Response::HTTP_UNAUTHORIZED) {
                    // JWT might have expired, try to authenticate again
                    $this->authenticate();
                    return $this->makeRequest($method, $endpoint, $options);
                }

                if ($statusCode === Response::HTTP_TOO_MANY_REQUESTS) {
                    $retryCount++;
                    $delay = $baseDelay * (2 ** $retryCount); // Exponential backoff
                    $this->logger->warning("Rate limit hit, waiting {$delay} seconds before retry {$retryCount}/{$maxRetries}");
                    sleep($delay);
                    continue;
                }

                if ($statusCode !== Response::HTTP_OK) {
                    throw new \RuntimeException("API request failed with status code: {$statusCode}");
                }

                $data = json_decode($response->getBody()->getContents(), true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
                }

                return $data;
            } catch (GuzzleException $e) {
                if ($e->hasResponse() && $e->getResponse()->getStatusCode() === Response::HTTP_TOO_MANY_REQUESTS) {
                    $retryCount++;
                    $delay = $baseDelay * (2 ** $retryCount); // Exponential backoff
                    $this->logger->warning("Rate limit hit, waiting {$delay} seconds before retry {$retryCount}/{$maxRetries}");
                    sleep($delay);
                    continue;
                }

                $this->logger->error('API request failed', [
                    'endpoint' => $endpoint,
                    'error' => $e->getMessage(),
                    'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null
                ]);
                throw new \RuntimeException('Failed to make API request: ' . $e->getMessage());
            }
        }

        throw new \RuntimeException("Failed to complete request after {$maxRetries} retries due to rate limiting");
    }

    /**
     * Get all makes with pagination
     */
    public function getMakes(int $page = 1, int $limit = 100): array
    {
        $response = $this->makeRequest('GET', "/api/makes", [
            'query' => [
                'page' => $page,
                'limit' => $limit
            ]
        ]);

        $this->logger->info('Car API makes response:', ['response' => $response]);

        // Handle different possible response structures
        if (isset($response['data'])) {
            return $response['data'];
        }

        if (isset($response['response']) && isset($response['response']['data'])) {
            return $response['response']['data'];
        }

        if (is_array($response) && !empty($response)) {
            return $response;
        }

        $this->logger->warning('Unexpected response structure from CarAPI makes endpoint', [
            'response' => $response
        ]);

        return [];
    }

    /**
     * Get all models for a specific make with pagination
     */
    public function getModels(string $makeId, int $page = 1, int $limit = 100): array
    {
        return $this->makeRequest('GET', "/api/models?make_id={$makeId}&page={$page}&limit={$limit}");
    }

    /**
     * Get all years for a specific model with pagination
     */
    public function getYears(string $modelId, int $page = 1, int $limit = 100): array
    {
        return $this->makeRequest('GET', "/api/years?model_id={$modelId}&page={$page}&limit={$limit}");
    }

    /**
     * Get all trims for a specific model and year with pagination
     */
    public function getTrims(string $modelId, int $year, int $page = 1, int $limit = 100): array
    {
        return $this->makeRequest('GET', "/api/trims?model_id={$modelId}&year={$year}&page={$page}&limit={$limit}");
    }

    /**
     * Get detailed information about a specific vehicle
     */
    public function getVehicle(string $vehicleId): array
    {
        return $this->makeRequest('GET', "/api/vehicles/{$vehicleId}");
    }

    /**
     * Get vehicle attributes (enumerated values)
     */
    public function getVehicleAttributes(): array
    {
        return $this->makeRequest('GET', '/api/vehicle-attributes');
    }

    /**
     * Search for vehicles with complex filters
     */
    public function searchVehicles(array $filters, int $page = 1, int $limit = 100): array
    {
        return $this->makeRequest('GET', '/api/vehicles', [
            'query' => [
                'json' => json_encode($filters),
                'page' => $page,
                'limit' => $limit
            ]
        ]);
    }

    private function clearExistingData(): void
    {
        try {
            // Check if the table exists first
            $connection = $this->em->getConnection();
            $tableExists = $connection->createSchemaManager()->tablesExist(['car_api']);

            if ($tableExists) {
                $this->logger->info('Clearing existing car data');
                $this->em->createQuery('DELETE FROM App\Entity\CarAPI c')->execute();
                $this->em->flush();
                $this->logger->info('Successfully cleared existing car data');
            } else {
                $this->logger->info('Car API table does not exist yet, skipping clear operation');
            }
        } catch (DBALException $e) {
            $this->logger->error('Database connection error while clearing data', [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            if (strpos($e->getMessage(), 'Connection refused') !== false) {
                // Get the current database host
                $databaseHost = $this->databaseService->getDatabaseHost();

                throw new \Exception(
                    "Cannot connect to the database at {$databaseHost}. Please ensure MySQL is running and accessible. " .
                    'Error: ' . $e->getMessage()
                );
            }

            throw $e;
        } catch (QueryException $e) {
            $this->logger->error('Query error while clearing data', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function makeApiRequest(string $endpoint, array $params = []): array
    {
        $maxRetries = 3;
        $retryDelay = 5; // seconds
        $attempt = 0;

        while ($attempt < $maxRetries) {
            try {
                $response = $this->client->request('GET', $endpoint, [
                    'query' => $params,
                    'headers' => [
                        'X-RapidAPI-Key' => $this->apiKey,
                        'X-RapidAPI-Host' => 'car-api2.p.rapidapi.com'
                    ]
                ]);

                if ($response->getStatusCode() === 429) {
                    $attempt++;
                    if ($attempt < $maxRetries) {
                        $this->logger->warning("Rate limited by API. Attempt {$attempt} of {$maxRetries}. Waiting {$retryDelay} seconds...");
                        sleep($retryDelay);
                        $retryDelay *= 2; // Exponential backoff
                        continue;
                    }
                }

                return json_decode($response->getContent(), true);
            } catch (\Exception $e) {
                $attempt++;
                if ($attempt < $maxRetries) {
                    $this->logger->warning("API request failed. Attempt {$attempt} of {$maxRetries}. Waiting {$retryDelay} seconds...");
                    sleep($retryDelay);
                    $retryDelay *= 2; // Exponential backoff
                    continue;
                }
                throw $e;
            }
        }

        throw new \RuntimeException("Failed to fetch data from Car API after {$maxRetries} attempts");
    }

    public function fetchAndStoreCarData(int $limit = 50): void
    {
        $this->logger->info("Starting to fetch car data from CarAPI (limit: {$limit})...");

        try {
            // Add initial delay before first request
            sleep(2);

            // Fetch makes
            $this->logger->info("Attempting to authenticate with CarAPI...");
            $makes = $this->makeApiRequest('/api/makes');
            $this->logger->info("Successfully authenticated with CarAPI");

            if (!isset($makes['data'])) {
                throw new \RuntimeException('Invalid response format from Car API');
            }

            $makes = array_slice($makes['data'], 0, $limit);
            $this->logger->info("Found " . count($makes) . " makes");

            foreach ($makes as $makeData) {
                try {
                    // Add delay between make requests
                    sleep(1);

                    $make = new Make();
                    $make->setName($makeData['name'] ?? 'Unknown');
                    $make->setLogo($makeData['logo'] ?? null);
                    $make->setApiId($makeData['id'] ?? null);
                    $this->entityManager->persist($make);
                    $this->entityManager->flush();

                    // Fetch models for this make
                    if (isset($makeData['id'])) {
                        // Add delay before model requests
                        sleep(1);

                        $models = $this->makeApiRequest('/api/models', ['make_id' => $makeData['id']]);

                        if (isset($models['data'])) {
                            foreach ($models['data'] as $modelData) {
                                $model = new Model();
                                $model->setName($modelData['name'] ?? 'Unknown');
                                $model->setMake($make);
                                $model->setApiId($modelData['id'] ?? null);
                                $this->entityManager->persist($model);
                            }
                            $this->entityManager->flush();
                        }
                    }
                } catch (\Exception $e) {
                    $this->logger->error("Error processing make {$makeData['name']}: " . $e->getMessage());
                    continue;
                }
            }

            $this->logger->info("Successfully stored car data");
        } catch (\Exception $e) {
            $this->logger->error("Error in fetchAndStoreCarData: " . $e->getMessage());
            throw $e;
        }
    }

    public function fetchCars(): array
    {
        $this->logger->info('Starting car data fetch process');

        $page = 1;
        $limit = 100;
        $totalProcessed = 0;
        $hasMore = true;
        $allCars = [];

        try {
            while ($hasMore) {
                $this->logger->info("Fetching page {$page} with limit {$limit}");

                $response = $this->makeRequest('GET', '/api/cars', [
                    'query' => [
                        'page' => $page,
                        'limit' => $limit,
                        'fields' => 'id,make,model,year,type,transmission,drive,engine_type,fuel_type'
                    ]
                ]);

                $data = $response;

                if (empty($data['data'])) {
                    $this->logger->info('No more car data available');
                    break;
                }

                $cars = $data['data'];
                $totalProcessed += count($cars);
                $allCars = array_merge($allCars, $cars);

                $this->logger->info("Processed {$totalProcessed} cars so far");

                // Check if there are more pages
                $pagination = $data['pagination'] ?? null;
                $hasMore = $pagination && $pagination['current_page'] < $pagination['total_pages'];

                if ($hasMore) {
                    $page++;
                    // Be nice to the API - add a small delay between requests
                    usleep(500000); // 0.5 second delay
                }
            }

            $this->logger->info("Car data fetch completed. Total cars processed: {$totalProcessed}");
            return $allCars;

        } catch (\Exception $e) {
            $this->logger->error('Failed to fetch car data from API', [
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Failed to fetch car data from API: ' . $e->getMessage(), 0, $e);
        }
    }

    private function processMake(array $makeData): void
    {
        try {
            if (!isset($makeData['id'], $makeData['name'])) {
                throw new \RuntimeException('Invalid make data structure: missing required fields');
            }

            $this->logger->info(sprintf('Processing make: %s', $makeData['name']));

            // Create a new CarAPI entity for this make
            $carApi = new \App\Entity\CarAPI();
            $carApi->setMake($makeData['name']);
            $carApi->setModel(''); // Will be updated when processing models
            $carApi->setYear(0); // Will be updated when processing years

            $this->em->persist($carApi);
            $this->em->flush();

            // Fetch models for this make
            $response = $this->getModels($makeData['id']);

            // Log the response structure for debugging
            $this->logger->info('Models API response:', ['response' => $response]);

            // Handle different possible response structures
            $models = [];
            if (isset($response['data'])) {
                $models = $response['data'];
            } elseif (isset($response['response']) && isset($response['response']['data'])) {
                $models = $response['response']['data'];
            } elseif (is_array($response) && !empty($response)) {
                $models = $response;
            }

            if (empty($models)) {
                $this->logger->warning('No models found for make: ' . $makeData['name']);
                return;
            }

            foreach ($models as $modelData) {
                if (!isset($modelData['id'], $modelData['name'])) {
                    $this->logger->warning('Skipping invalid model data: missing required fields');
                    continue;
                }

                $this->logger->info(sprintf('Processing model: %s', $modelData['name']));

                // Create a new CarAPI entity for this model
                $modelCarApi = new \App\Entity\CarAPI();
                $modelCarApi->setMake($makeData['name']);
                $modelCarApi->setModel($modelData['name']);
                $modelCarApi->setYear(0); // Will be updated when processing years

                $this->em->persist($modelCarApi);
                $this->em->flush();

                // Fetch years for this model
                $yearResponse = $this->getYears($modelData['id']);

                // Log the response structure for debugging
                $this->logger->info('Years API response:', ['response' => $yearResponse]);

                // Handle different possible response structures for years
                $years = [];
                if (isset($yearResponse['data'])) {
                    $years = $yearResponse['data'];
                } elseif (isset($yearResponse['response']) && isset($yearResponse['response']['data'])) {
                    $years = $yearResponse['response']['data'];
                } elseif (is_array($yearResponse) && !empty($yearResponse)) {
                    $years = $yearResponse;
                }

                if (empty($years)) {
                    $this->logger->warning('No years found for model: ' . $modelData['name']);
                    continue;
                }

                foreach ($years as $yearData) {
                    if (!isset($yearData['id'], $yearData['year'])) {
                        $this->logger->warning('Skipping invalid year data: missing required fields');
                        continue;
                    }

                    $this->logger->info(sprintf('Processing year: %s', $yearData['year']));

                    // Create a new CarAPI entity for this year
                    $yearCarApi = new \App\Entity\CarAPI();
                    $yearCarApi->setMake($makeData['name']);
                    $yearCarApi->setModel($modelData['name']);
                    $yearCarApi->setYear($yearData['year']);

                    $this->em->persist($yearCarApi);
                    $this->em->flush();
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('Error in processMake: ' . $e->getMessage());
            throw $e;
        }
    }
}