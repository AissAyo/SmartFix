<?php
namespace App\Controller\AdminController\Stats;

use App\Repository\ClientRepository;
use App\Repository\SellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class statisticContorller extends AbstractController
{
    private ClientRepository $clientRepository;
    private SellerRepository $sellerRepository;

    public function __construct(ClientRepository $clientRepository, SellerRepository $sellerRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->sellerRepository = $sellerRepository;
    }

    #[Route(path: '/dashboard', name: 'chart_seller', methods: ['GET'])]
    public function getClientCity(ChartBuilderInterface $chartBuilder): Response
    {
        // Fetch grouped data
        $Clientscities = $this->clientRepository->getClientByCity();
        $Sellercities = $this->sellerRepository->getSellerByCity();

        // Build a unified list of all cities and counts
        $cityMap = [];

        foreach ($Clientscities as $clientCity) {
            $city = $clientCity['city'];
            $cityMap[$city]['client'] = $clientCity['city_count'];
        }

        foreach ($Sellercities as $sellerCity) {
            $city = $sellerCity['city'];
            if (!isset($cityMap[$city]['client'])) {
                $cityMap[$city]['client'] = 0;
            }
            $cityMap[$city]['seller'] = $sellerCity['city_count'];
        }

        // Ensure all cities have both values
        foreach ($cityMap as $city => &$data) {
            $data['client'] = $data['client'] ?? 0;
            $data['seller'] = $data['seller'] ?? 0;
        }

        // Extract labels and values for chart
        $labels = array_keys($cityMap);
        $clientData = array_column($cityMap, 'client');
        $sellerData = array_column($cityMap, 'seller');

        // Build the chart
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Client Count',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'data' => $clientData,
                ],
                [
                    'label' => 'Seller Count',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.6)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'data' => $sellerData,
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ]);

        return $this->render('Admin/Dashboards/Dashboard.html.twig', [
            'chart' => $chart,
        ]);
    }


}
