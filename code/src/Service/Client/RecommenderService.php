<?php

namespace App\Service\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class RecommenderService
{
    private HttpClientInterface $client;
    private string $recommenderUrl;

    public function __construct(HttpClientInterface $client, string $recommenderUrl)
    {
        $this->client = $client;
        $this->recommenderUrl = $recommenderUrl;
    }

    public function getRecommendedGarageIds(int $clientId): array
    {
        try {
            $response = $this->client->request('GET', $this->recommenderUrl);
            $data = json_decode($response->getContent(), true);

            if (isset($data['recommended_garages'])) {
                return $data['recommended_garages'];
            }

            return [];
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            return [];
        }
    }
} 