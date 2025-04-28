<?php

namespace App\Service\authAdmin;

use App\Repository\AdminRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class authAdminService
{
//    private AdminRepository $adminRepository;
//    private SessionInterface $session;
//    private UserPasswordHasherInterface $hasher;
//    private LoggerInterface $logger;
//
//    public function __construct(
//        AdminRepository $adminRepository,
//        SessionInterface $session,
//        UserPasswordHasherInterface $hasher,
//        LoggerInterface $logger,
//        private RequestStack $requestStack,
//    ) {
//        $this->adminRepository = $adminRepository;
//        $this->session = $session;
//        $this->hasher = $hasher;
//        $this->logger = $logger;
//    }
//
//    public function login(string $email, string $password): bool
//    {
//        $session = $this->requestStack->getSession();
//        $admin = $this->adminRepository->findOneBy(['email' => $email]);
//        $success = false;
//
//        if ($admin && $this->hasher->isPasswordValid($admin, $password)) {
//            // Optionally, you can set session data here
//            $this->session->set('admin_id', $admin->getId());
//            $success = true;
//        }
//
//        // Log the login attempt
//        $this->logger->info('Login attempt', [
//            'email' => $email,
//            'success' => $success,
//            'timestamp' => date('Y-m-d H:i:s'),
//        ]);
//
//        return $success;
//    }
}