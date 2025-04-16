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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\File\File;



class AdminCrudMechanicController extends AbstractController
{
    private MechanicService $mechanicService;
    private FileUploader $fileUploader;
    public function __construct(MechanicService $mechanicService, FileUploader $fileUploader)
    {
        $this->mechanicService = $mechanicService;
        $this->fileUploader = $fileUploader; // ✅ injected and assigned
    }


    #[Route('listmechanic/{page}', name: 'admin_list_mechanic', defaults: ['page' => 1])]
    public function listMechanic(EntityManagerInterface $entityManager, int $page, PaginatorInterface $paginator): Response
    {
        $mechanic = $entityManager->getRepository(Mechanic::class)
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC');  // Default sorting
        $pagination = $paginator->paginate(
            $mechanic,
            $page,
            10
        );
        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanic.html.twig', [
            'pagination' => $pagination,
         //   'mechanics' => $pagination->getItems(),
        ]);
    }



    #[Route('addmechanic', name: 'admin_mechanics_add', methods: ['GET', 'POST'])]
    public function addMechanic(Request $request): Response
    {
        $mechanic = new Mechanic();
        $form = $this->createForm(MechanicType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logoFile')->getData();
            $photoProfilFile = $form->get('MechanicphotoProfilFile')->getData();

            // Handle logo file upload
            if ($logoFile) {
                $logoPath = $this->fileUploader->upload($logoFile);
                // Set the path to the logo property (not logoFile)
                $mechanic->setLogo($logoPath);
                // Set the actual File object for VichUploader
             //   $mechanic->setLogoFile($logoFile);
            }

            // Handle profile photo upload
            if ($photoProfilFile) {
                $photoPath = $this->fileUploader->upload($photoProfilFile);
                // Set the path to the photoProfil property
                $mechanic->setPhotoProfil($photoPath);
                // Set the actual File object for VichUploader
              //   $mechanic->setMechanicphotoProfilFile($photoProfilFile);
            }

            $this->mechanicService->createMechanic($mechanic);
            $this->addFlash('success', 'Mechanic created successfully!');
            return $this->redirectToRoute('admin_list_mechanic');
        }

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicAdd.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/editmechanic/{id}', name: 'admin_mechanics_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, FileUploader $fileUploader, EntityManagerInterface $entityManager): Response
    {
        // Find the mechanic by its ID
        $mechanic = $entityManager->getRepository(mechanic::class)->find($id);

        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }

        // Create the form and bind it to the existing mechanic data
        $form = $this->createForm(mechanicType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            // Handle file upload for the profile photo
            $photoProfil = $form->get('MechanicphotoProfilFile')->getData();
            $logoFile = $form->get('logoFile')->getData();

            if ($photoProfil) {
                $mechanicPhotoProfilFile = $fileUploader->upload($photoProfil);
                $mechanic->setPhotoProfil($mechanicPhotoProfilFile);
            }
            if ($logoFile) {
                $logoPath = $this->fileUploader->upload($logoFile);
                $mechanic->setLogo($logoPath);

            }

            // Persist the updated mechanic entity
            $entityManager->persist($mechanic);
            $entityManager->flush();

            // Redirect to the list of mechanics after successful update
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

        return $this->render('Admin/CRUD/Mechanic/adminCrudMechanicShow.html.twig', ['mechanic' => $mechanic]);
    }

    #[Route('deletemechanic/{id}', name: 'admin_mechanics_delete', methods: ['POST'])]
    public function deleteMechanic(Request $request, int $id): Response
    {
        $mechanic = $this->mechanicService->getMechanic($id);

        if (!$mechanic) {
            throw $this->createNotFoundException('No mechanic found for id ' . $id);
        }

        if ($this->isCsrfTokenValid('delete' . $mechanic->getId(), $request->request->get('_token'))) {
            // Delete the mechanic
            $this->mechanicService->deleteMechanic($mechanic);
            $this->addFlash('success', 'Mechanic deleted successfully!');
        }
        $lastPage = 1;
        return $this->redirectToRoute('admin_list_mechanic',['page' => $lastPage]);
    }
}
