<?php

namespace App\Controller\Python;

use App\Service\python_http\HealthCheckService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PythonController extends AbstractController
{
private HealthCheckService $healthCheckService;

public function __construct(HealthCheckService $healthCheckService)
{
$this->healthCheckService = $healthCheckService;
}

#[Route('/pythonhealth', name: 'pythonhealth')]
public function healthCheck(): JsonResponse
{
$data = $this->healthCheckService->healthCheck();
return new JsonResponse($data);
}
}
