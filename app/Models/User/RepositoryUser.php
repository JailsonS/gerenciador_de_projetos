<?php
namespace App\Models\User;

use App\Models\Email;

interface RepositoryUser
{
    public function doLogin(Email $email, string $password): void;
    public function logout(): void;
}
