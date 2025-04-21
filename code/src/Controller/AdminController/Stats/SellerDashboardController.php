<?php
namespace App\Controller\AdminController\Stats;

use App\Repository\SellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class SellerDashboardController extends AbstractController
{
    private SellerRepository $SellerRepository;

    public function __construct(SellerRepository $SellerRepository)
    {
        $this->SellerRepository = $SellerRepository;
    }

    #[Route(path: '/SellerDashboard', name: 'chart_Seller', methods: ['GET'])]
    public function dashboard(ChartBuilderInterface $chartBuilder): Response
    {
        // Fetch grouped Seller data
        $SellersCities = $this->SellerRepository->getSellerByCity();
        $allSellers = $this->SellerRepository->getAllEntities(); // Fetch all Sellers for total count

        // Prepare chart data
        $labels = [];
        $SellerData = [];

        foreach ($SellersCities as $SellerCity) {
            $labels[] = $SellerCity['city'];
            $SellerData[] = $SellerCity['city_count'];
        }

        // Build the chart
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Seller Count',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'data' => $SellerData,
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
//        $Sellersstatus = $this->SellerRepository->getSellerBystatus();
//        $labels = [];
//        $SellerData = [];
//
//        // Loop through the status data and organize it into labels and data
//        foreach ($Sellersstatus as $status) {
//            // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
//            $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';
//
//            $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
//            $SellerData[] = $status['Seller_count'];  // The count for that status
//        }
//
//        // Create the pie chart using the chart builder
//        $chartc = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
//        $chartc->setData([
//            'labels' => $labels,
//            'datasets' => [
//                [
//                    'label' => 'Seller Statuses',
//
//                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
//                    'data' => $SellerData,
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

        return $this->render('Admin/Dashboards/Seller/SellerDashboard.html.twig', [
            'chart' => $chart,
            'Sellercount' => count($allSellers),
//            'chartc' => $chartc,
        ]);
    }
    #[Route(path: '/cyrcle', name: 'dashboard_index', methods: ['GET'])]
    public function cyrcle(ChartBuilderInterface $chartBuilder): Response
    {
        $Sellersstatus = $this->SellerRepository->getSellerBystatus();
        $labels = [];
        $SellerData = [];

        // Loop through the status data and organize it into labels and data
        foreach ($Sellersstatus as $status) {
            // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
            $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';

            $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
            $SellerData[] = $status['Seller_count'];  // The count for that status
        }

        // Create the pie chart using the chart builder
        $chartc = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
        $chartc->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Seller Statuses',

                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
                    'data' => $SellerData,
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
        $Sellersstatus = $this->SellerRepository->getSellerBystatus();
        $labels = [];
        $SellerData = [];

        // Loop through the status data and organize it into labels and data
        foreach ($Sellersstatus as $status) {
            // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
            $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';

            $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
            $SellerData[] = $status['Seller_count'];  // The count for that status
        }

        // Create the pie chart using the chart builder
        $chart = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Seller Statuses',

                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
                    'data' => $SellerData,
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
