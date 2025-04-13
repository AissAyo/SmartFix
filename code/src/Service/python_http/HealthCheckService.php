<?php

namespace App\Service\python_http;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HealthCheckService
{
private $client;

public function __construct(HttpClientInterface $client)
{
$this->client = $client;
}

public function healthCheck(): array
{
$response = $this->client->request('GET', 'http://python:8000/health');
return $response->toArray();
}
}
