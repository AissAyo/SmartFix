<?php
namespace App\Controller\AdminController;

use App\Entity\Shop;
use App\Entity\Seller;
use App\Form\Type\SellerType;
use App\Repository\SellerRepository;
use App\Service\SellerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCrudSellerController extends AbstractController
{
    private SellerService $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }
    #[Route('listseller', name: 'admin_list_seller')]
    public function listSeller (Request $request, EntityManagerInterface $entityManager): Response
    {

        $seller = $this->sellerService->getAllSellers();
        return $this->render('Admin/adminCrudSeller.html.twig', ['sellers' => $seller]);
    }
    #[Route('createseller', name: 'admin_create_seller')]
    public function addSeller (Request $request, EntityManagerInterface $entityManager): Response
    {
        $seller = $this->sellerService->createSeller();
        $form = $this->createForm(SellerType::class, $seller);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seller);
            $entityManager->flush();
            return $this->redirectToRoute('admin_list_seller');
        }
    }
}