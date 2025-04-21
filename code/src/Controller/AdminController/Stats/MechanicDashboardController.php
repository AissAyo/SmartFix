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

    #[Route(path: '/MechanicDashboard', name: 'chart_Mechanic', methods: ['GET'])]
    public function dashboard(ChartBuilderInterface $chartBuilder): Response
    {
        // Fetch grouped Mechanic data
        $MechanicsCities = $this->MechanicRepository->getMechanicByCity();
        $allMechanics = $this->MechanicRepository->getAllEntities(); // Fetch all Mechanics for total count

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
        //cycle chart
//        $Mechanicsstatus = $this->MechanicRepository->getMechanicBystatus();
//        $labels = [];
//        $MechanicData = [];
//
//        // Loop through the status data and organize it into labels and data
//        foreach ($Mechanicsstatus as $status) {
//            // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
//            $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';
//
//            $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
//            $MechanicData[] = $status['Mechanic_count'];  // The count for that status
//        }
//
//        // Create the pie chart using the chart builder
//        $chartc = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
//        $chartc->setData([
//            'labels' => $labels,
//            'datasets' => [
//                [
//                    'label' => 'Mechanic Statuses',
//
//                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
//                    'data' => $MechanicData,
//                ],
//            ],
//        ]);
//
//        // Set chart options if necessary (e.g., adding tooltips, legend, etc.)
//        $chartc->setOptions([
//            'plugins' => [
//                'legend' => [
//                    'display' => true, // Show the legend
//                ],
//            ],
//        ]);

        return $this->render('Admin/Dashboards/Mechanic/MechanicDashboard.html.twig', [
            'chart' => $chart,
            'Mechaniccount' => count($allMechanics),
            //'chartc' => $chartc,
        ]);
    }
    #[Route(path: '/cyrcle', name: 'dashboard_index', methods: ['GET'])]
    public function cyrcle(ChartBuilderInterface $chartBuilder): Response
    {
        $Mechanicsstatus = $this->MechanicRepository->getMechanicBystatus();
        $labels = [];
        $MechanicData = [];

        // Loop through the status data and organize it into labels and data
        foreach ($Mechanicsstatus as $status) {
            // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
            $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';

            $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
            $MechanicData[] = $status['Mechanic_count'];  // The count for that status
        }

        // Create the pie chart using the chart builder
        $chartc = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
        $chartc->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Mechanic Statuses',

                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
                    'data' => $MechanicData,
                ],
            ],
        ]);

        // Set chart options if necessary (e.g., adding tooltips, legend, etc.)
        $chartc->setOptions([
            'plugins' => [
                'legend' => [
                    'display' => true, // Show the legend
                ],
            ],
        ]);

        // Render the chart in the view
        return $this->render('MechanicIndexGarage.html.twig', [
            'chartc' => $chartc,
        ]);
    }
    #[Route(path: '/cyrcle1', name: 'dashboard_index', methods: ['GET'])]
    public function cyrcle1(ChartBuilderInterface $chartBuilder): Response
    {
        $Mechanicsstatus = $this->MechanicRepository->getMechanicBystatus();
        $labels = [];
        $MechanicData = [];

        // Loop through the status data and organize it into labels and data
        foreach ($Mechanicsstatus as $status) {
            // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
            $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';

            $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
            $MechanicData[] = $status['Mechanic_count'];  // The count for that status
        }

        // Create the pie chart using the chart builder
        $chart = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Mechanic Statuses',

                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
                    'data' => $MechanicData,
                ],
            ],
        ]);

        // Set chart options if necessary (e.g., adding tooltips, legend, etc.)
        $chart->setOptions([
            'plugins' => [
                'legend' => [
                    'display' => true, // Show the legend
                ],
            ],
        ]);

        // Render the chart in the view
        return $this->render('MechanicIndexGarage.html.twig', [
            'chart' => $chart,
        ]);
    }

}
