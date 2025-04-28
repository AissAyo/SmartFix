<?php
// src/Controller/GarageChartController.php
namespace App\Controller\AdminController\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GarageRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilder;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class GarageChartController extends AbstractController
{
    private GarageRepository $garageRepository;
    private ChartBuilderInterface $chartBuilder;
    public function __construct(GarageRepository $garageRepository)
    {
        $this->garageRepository = $garageRepository;
        $this->chartBuilder = new ChartBuilder();
    }
    #[Route('/garagechart', name: 'garage_chart', methods: ['GET'])]
        public function garageChartpercity(

    ): Response {
        // Fetch grouped Garage data
        $garageCities = $this->garageRepository->getgarageByCity();

        // Prepare chart data
        $labels = [];
        $garageData = [];

        foreach ($garageCities as $garageCity) {
            $labels[] = $garageCity['City'];
            $garageData[] = $garageCity['city_count'];
        }

        // Build the chart
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [[
                'label' => 'Garage Count',
                'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'data' => $garageData,
            ]],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ]);

        return $this->render('Admin/Dashboards/garage/garage_chart.html.twig', [
            'chart' => $chart,
        ]);}
    #[Route('/getallgarges', name: 'get_all_garages', methods: ['GET'])]
    public function getallgarages(): Response
    {
        $allgarges=$this->garageRepository->findAll();
        return $this->render('Admin/Dashboards/garage/garagecount.html.twig', [
            'allgargas' => count($allgarges)
        ]);
    }
}
