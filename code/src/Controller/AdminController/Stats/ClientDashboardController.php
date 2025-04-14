<?php
    namespace App\Controller\AdminController\Stats;

    use App\Repository\ClientRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
    use Symfony\UX\Chartjs\Model\Chart;

    class ClientDashboardController extends AbstractController
    {
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
    $this->clientRepository = $clientRepository;
    }

    #[Route(path: '/ClientDashboard', name: 'chart_client', methods: ['GET'])]
    public function dashboard(ChartBuilderInterface $chartBuilder): Response
    {
    // Fetch grouped client data
    $clientsCities = $this->clientRepository->getClientByCity();
    $allClients = $this->clientRepository->getAllEntities(); // Fetch all clients for total count

    // Prepare chart data
    $labels = [];
    $clientData = [];

    foreach ($clientsCities as $clientCity) {
    $labels[] = $clientCity['city'];
    $clientData[] = $clientCity['city_count'];
    }

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
        $clientsstatus = $this->clientRepository->getClientBystatus();
        $labels = [];
        $clientData = [];

        // Loop through the status data and organize it into labels and data
        foreach ($clientsstatus as $status) {
            // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
            $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';

            $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
            $clientData[] = $status['client_count'];  // The count for that status
        }

        // Create the pie chart using the chart builder
        $chartc = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
        $chartc->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Client Statuses',

                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
                    'data' => $clientData,
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

    return $this->render('Admin/Dashboards/Client/ClientDashboard.html.twig', [
    'chart' => $chart,
    'clientcount' => count($allClients),
        'chartc' => $chartc,
    ]);
    }
        #[Route(path: '/cyrcle', name: 'dashboard_index', methods: ['GET'])]
        public function cyrcle(ChartBuilderInterface $chartBuilder): Response
        {
            $clientsstatus = $this->clientRepository->getClientBystatus();
            $labels = [];
            $clientData = [];

            // Loop through the status data and organize it into labels and data
            foreach ($clientsstatus as $status) {
                // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
                $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';

                $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
                $clientData[] = $status['client_count'];  // The count for that status
            }

            // Create the pie chart using the chart builder
            $chartc = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
            $chartc->setData([
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Client Statuses',

                        'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
                        'data' => $clientData,
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
            return $this->render('index.html.twig', [
                'chartc' => $chartc,
            ]);
        }
        #[Route(path: '/cyrcle1', name: 'dashboard_index', methods: ['GET'])]
        public function cyrcle1(ChartBuilderInterface $chartBuilder): Response
        {
            $clientsstatus = $this->clientRepository->getClientBystatus();
            $labels = [];
            $clientData = [];

            // Loop through the status data and organize it into labels and data
            foreach ($clientsstatus as $status) {
                // Convert 'true' to 'Verified' and 'false' to 'Not Verified'
                $statusLabel = $status['verificationStatus'] ? 'Verified' : 'Not Verified';

                $labels[] = $statusLabel;  // The status label (e.g., "Verified", "Not Verified")
                $clientData[] = $status['client_count'];  // The count for that status
            }

            // Create the pie chart using the chart builder
            $chart = $chartBuilder->createChart(Chart::TYPE_PIE);  // You can use Chart::TYPE_DOUGHNUT for doughnut chart
            $chart->setData([
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Client Statuses',

                        'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56'], // Customize colors as needed
                        'data' => $clientData,
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
            return $this->render('index.html.twig', [
                'chart' => $chart,
            ]);
        }

    }
