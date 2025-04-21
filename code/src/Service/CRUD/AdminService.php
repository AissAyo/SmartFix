<?php

namespace App\Service\CRUD;

use App\Entity\Admin;

use App\Repository\AdminRepository;
use Symfony\Bundle\SecurityBundle\Security;

class AdminService
{

    public function __construct(
        private AdminRepository$AdminRepository,
        private Security $security  // <-- Add this
    ) {}

    public function getAdmin(int $id): ?Admin
    {
        return $this->AdminRepository->getEntityById($id);
    }



    public function deleteAdmin(Admin $Admin, bool $flush = true): void
    {
        $Admin=$this->security->getUser();
        $this->AdminRepository->deleteEntity($Admin);
    }

    public function getAdminByEmailAndPassword(?string $email , string $password): bool
    {
        return $this->AdminRepository->getAdminByEmailAndPassword($email,$password);
    }



    public function getCurrentAdmin(): ?Admin
    {
        $user = $this->security->getUser();
        return $user instanceof Admin ? $user : null;
    }

}