<?php

namespace App\Service\authAdmin;

interface AdminAuthServiceInterface
{
    public function login(string $email, string $password): bool;
}