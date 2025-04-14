<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/api/car-types', name: 'app_car_types', methods: ['GET'])]
    public function getCarTypes(): JsonResponse
    {
        // Get API key from environment variables
        $apiKey = $_ENV['RAPIDAPI_KEY'] ?? null;

        if (!$apiKey) {
            return $this->json(
                ['error' => 'API key not configured'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://car-data.p.rapidapi.com/cars/types",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: car-data.p.rapidapi.com",
                "x-rapidapi-key: $apiKey"  // Use the variable here
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($err) {
            return $this->json(
                ['error' => $err],
                Response::HTTP_BAD_GATEWAY
            );
        }

        // Validate the response is valid JSON
        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(
                ['error' => 'Invalid API response format'],
                Response::HTTP_BAD_GATEWAY
            );
        }

        return $this->json($decoded);
    }
}