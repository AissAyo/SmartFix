<?php
namespace App\Controller\AdminController\Stats;

use App\Repository\MechanicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class MechanicDashboardController extends AbstractController
{
    private MechanicRepository $MechanicRepository;

    public function __construct(MechanicRepository $MechanicRepository)
    {
        $this->MechanicRepository = $MechanicRepository;
    }

    #[Route(path: '/MechanicDashboard', name: 'Dashboard_Mechanic', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Admin/Dashboards/Mechanic/MechanicDashboard.html.twig');
    }
    #[Route(path: '/MechanicChart', name: 'chart_Mechanic', methods: ['GET'])]
    public function dashboard(ChartBuilderInterface $chartBuilder): Response
    {
        // Fetch grouped Mechanic data
        $MechanicsCities = $this->MechanicRepository->getMechanicByCity();

        // Prepare chart data
        $labels = [];
        $MechanicData = [];

        foreach ($MechanicsCities as $MechanicCity) {
            $labels[] = $MechanicCity['city'];
            $MechanicData[] = $MechanicCity['city_count'];
        }

        // Build the chart
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Mechanic Count',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'data' => $MechanicData,
                ]
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ]);


        return $this->render('Admin/Dashboards/Mechanic/MechanicChart.html.twig', [
            'chart' => $chart,

        ]);
    }
    #[Route(path: '/mechaniccount', name: 'mechanic_count_per_city', methods: ['GET'])]
    public function mechaniccountpercity(): Response
    {
        $allMechanics = $this->MechanicRepository->getAllEntities();
        return $this->render('Admin/Dashboards/Mechanic/mechaniccount.html.twig', [
            'Mechaniccount' => count($allMechanics),
        ]);
    }



}
