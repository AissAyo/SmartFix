<?php
namespace App\Controller\AdminController\CRUD;

use App\Entity\Seller;
use App\Service\CRUD\SellerService;
use App\Type\SellerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  AdminCrudSellerController extends AbstractController
{
    private SellerService $sellerService;

    public function __construct(
        SellerService $sellerService,
    )
    {
        $this->sellerService = $sellerService;
    }

    #[Route('listseller', name: 'admin_list_seller')]
    public function listSeller(): Response
    {
        $sellers = $this->sellerService->getAllSellers();
        return $this->render('Admin/CRUD/Seller/adminCrudSeller.html.twig', ['sellers' => $sellers]);
    }

    #[Route('addseller', name: 'admin_sellers_add', methods: ['GET', 'POST'])]
    public function addSeller(Request $request): Response
    {
        $seller = new Seller();
        $form = $this->createForm(SellerType::class, $seller);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->sellerService->createSeller($seller);
                $this->addFlash('success', 'Seller created successfully!');
                return $this->redirectToRoute('admin_list_seller');
            } else {
                // Debug form errors
                $errors = $form->getErrors(true);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
        }

        return $this->render('Admin/CRUD/Seller/adminCrudSellerAdd.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/editseller/{id}', name: 'admin_sellers_edit', methods: ['GET', 'POST'])]
    public function editSeller(Request $request, int $id): Response
    {
        $seller = $this->sellerService->getSeller($id);
        if (!$seller) {
            throw $this->createNotFoundException('No seller found for id ' . $id);
        }

        $form = $this->createForm(SellerType::class, $seller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->sellerService->updateSeller($seller);
            return $this->redirectToRoute('admin_list_seller');
        }

        return $this->render('Admin/CRUD/Seller/adminCrudSellerEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('showseller/{id}', name: 'admin_sellers_show', methods: ['GET'])]
    public function showSeller(int $id): Response
    {
        $seller = $this->sellerService->getSeller($id);
        if (!$seller) {
            throw $this->createNotFoundException('No seller found for id ' . $id);
        }

        return $this->render('Admin/CRUD/Seller/adminCrudSellerShow.html.twig', ['seller' => $seller]);
    }

    #[Route('deleteseller/{id}', name: 'admin_sellers_delete', methods: ['POST'])]
    public function deleteSeller(Request $request, int $id): Response
    {
        $seller = $this->sellerService->getSeller($id);
        if (!$seller) {
            throw $this->createNotFoundException('No seller found for id ' . $id);
        }

        if ($this->isCsrfTokenValid('delete' . $seller->getId(), $request->request->get('_token'))) {
            $this->sellerService->deleteSeller($seller);
        }

        return $this->redirectToRoute('admin_list_seller');
    }
}