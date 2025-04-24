<?php

namespace App\Controller\AdminController\CRUD;

use App\Entity\Mechanic;
use App\Service\CRUD\MechanicService;
use App\Type\MechanicType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;

class AdminCrudMechanicController extends AbstractController
{
    private MechanicService $mechanicService;
    
    private FileUploader $fileUploader;

    public function __construct(MechanicService $mechanicService, FileUploader $fileUploader)
    {
        $this->mechanicService = $mechanicService;
        $this->fileUploader = $fileUploader;
    }

    #[Route('listmechanic/{page}', name: 'admin_list_mechanic', defaults: ['page' => 1])]
    public function listMechanic(EntityManagerInterface $entityManager, int $page, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $entityManager->getRepository(Mechanic::class)
            ->createQueryBuilder('m')
            ->orderBy('m.name', 'ASC');

        $pagination = $paginator->paginate($queryBuilder, $page, 10);

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanic.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('addmechanic', name: 'admin_mechanics_add', methods: ['GET', 'POST'])]
    public function addMechanic(Request $request): Response
    {
        $mechanic = new Mechanic();
        $form = $this->createForm(MechanicType::class, $mechanic);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Retrieve the uploaded file
            $photoProfilFile = $form->get('photoProfilFile')->getData();
    
            // Debugging: Check if the file is uploaded
            if (!$photoProfilFile) {
                $this->addFlash('error', 'No file was uploaded.');
                return $this->redirectToRoute('admin_mechanics_add');
            }
    
            if (!$photoProfilFile instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                $this->addFlash('error', 'Invalid file upload.');
                return $this->redirectToRoute('admin_mechanics_add');
            }
    
            // Handle the file upload
            if ($photoProfilFile) {
                $mechanic->setPhotoProfilFile($photoProfilFile); // VichUploader will handle the upload
            }
    
            // Persist the mechanic entity
            $this->mechanicService->createMechanic($mechanic);
    
            $this->addFlash('success', 'Mechanic created successfully!');
            return $this->redirectToRoute('admin_list_mechanic');
        }
    
        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicAdd.html.twig', [
            'form' => $form->createView(),
        ]);
    }
//    #[Route('/editmechanic/{id}', name: 'admin_mechanics_edit', methods: ['GET', 'POST'])]
//    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
//    {
//        $mechanic = $entityManager->getRepository(Mechanic::class)->find($id);
//
//        if (!$mechanic) {
//            throw $this->createNotFoundException('No mechanic found for id ' . $id);
//        }
//
//        $form = $this->createForm(MechanicType::class, $mechanic);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $photoProfil = $form->get('photoProfilFile')->getData();
//            $logoFile = $form->get('logoFile')->getData();
//
//            if ($photoProfil) {
//                $photoPath = $this->fileUploader->upload($photoProfil);
//                $mechanic->setPhotoProfil($photoPath);
//            }
//
//            if ($logoFile) {
//                $logoPath = $this->fileUploader->upload($logoFile);
//                $mechanic->setLogo($logoPath);
//            }
//
//            $entityManager->flush();
//
//            return $this->redirectToRoute('admin_list_mechanic');
//        }
//
//        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicEdit.html.twig', [
//            'mechanic' => $mechanic,
//            'form' => $form->createView(),
//        ]);
//    }

    #[Route('/editmechanic/{id}', name: 'admin_mechanics_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $mechanic = $entityManager->getRepository(Mechanic::class)->find($id);

        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }
        

        $form = $this->createForm(MechanicType::class, $mechanic);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // No need to manually upload files, VichUploader will do this for you

            // Just persist the changes
            $entityManager->flush();

            return $this->redirectToRoute('admin_list_mechanic');
        }

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicEdit.html.twig', [
            'mechanic' => $mechanic,
            'form' => $form->createView(),
        ]);
    }


    #[Route('showmechanic/{id}', name: 'admin_mechanics_show', methods: ['GET'])]
    public function showMechanic(int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);

        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicShow.html.twig', [
            'mechanic' => $mechanic,
        ]);
    }

    #[Route('deletemechanic/{id}', name: 'admin_mechanics_delete', methods: ['POST'])]
    public function deleteMechanic(Request $request, int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);

        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }

        if ($this->isCsrfTokenValid('delete' . $mechanic->getId(), $request->request->get('_token'))) {
            $this->mechanicService->deleteMechanic($mechanic);
            $this->addFlash('success', 'Mechanic deleted successfully!');
        }

        return $this->redirectToRoute('admin_list_mechanic', ['page' => 1]);
    }
}
