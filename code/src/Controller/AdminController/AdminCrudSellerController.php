<?php
namespace App\Controller\AdminController;

use App\Entity\Shop;
use App\Entity\Seller;
use App\Form\Type\SellerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCrudSellerController extends AbstractController
{
    #[Route('/admin/addseller', name: 'admin_add_seller')]
    public function addseller(Request $request, EntityManagerInterface $entityManager): Response
    {
        //$seller = new Seller();
       // $form = $this->createForm(SellerType::class, $seller); // Create form based on SellerType
        //$form->handleRequest($request);
        $shop = new shop();
        $shop->setName('shop1');
        $shop->setlocation('address1');
        //if ($form->isSubmitted() && $form->isValid()) {
          //  $seller->setcontactInfo('halawa');
            $entityManager->persist($shop);
            $entityManager->flush();
           // $entityManager->flush();

            return new Response('Saved new seller with id ');
           // return $this->render('Admin/addseller.html.twig', [
                    //  'form' => $form->createView(),
               //   ]);
     //   }

        //  return $this->render('admin/addseller.html.twig', [
      //      'form' => $form->createView(),
        //]);
    }
}