<?php

namespace App\Service\python_http;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GarageMatchService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getMatchedGarages(int $clientId): array
    {
        $response = $this->client->request('POST', 'http://python:8000/match-garages', [
            'json' => ['client_id' => $clientId]
        ]);
        
        return $response->toArray();
    }
} 