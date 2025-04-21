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

    return $this->render('Admin/Dashboards/Client/ClientDashboard.html.twig');
    }
     #[Route(path: '/clientcount', name: 'client_count', methods: ['GET'])]
        public function clientcount(): Response
        {
            $clientsstatus = $this->clientRepository->getAllEntities();

            return $this->render('Admin/Dashboards/Client/clientcount.html.twig', [
                'clientcount' => count($clientsstatus)
            ]);
        }

     #[Route(path: '/verfication', name: 'vervication_status', methods: ['GET'])]
        public function verfication(ChartBuilderInterface $chartBuilder): Response
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
            return $this->render('Admin/Dashboards/Client/clientcycle.html.twig', [
                'chartc' => $chartc,

            ]);
        }
        ///////////////////////////////////////////////////
        #[Route(path: '/clientpercity', name: 'client_by_city', methods: ['GET'])]
        public function clientByCity(ChartBuilderInterface $chartBuilder): Response{

            $clientsCities = $this->clientRepository->getClientByCity();
            $allClients = $this->clientRepository->getAllEntities(); // Fetch all clients for total count

            // Prepare chart data
            $labels = [];static
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
            return $this->render('Admin/Dashboards/Client/clientpercity.html.twig',[
                'chart' => $chart,
            ]);
        }

    }
