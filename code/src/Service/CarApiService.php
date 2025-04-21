<?php

namespace App\Service;

class CarApiService
{
    private string $client ='ayoub';

        public function __construct(Client $client)
        {
            $this->client = $client;
        }
}