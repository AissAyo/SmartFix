<?php
namespace App\Controller\AdminController;


use App\Entity\Seller;
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

        $seller = new Seller();//= $this->sellerService->getAllSellers();
        return $this->render('Admin/adminCrudSeller.html.twig', ['sellers' => $seller]);
    }

}