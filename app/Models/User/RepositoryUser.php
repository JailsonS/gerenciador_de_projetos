<?php
namespace App\Models\User;

use App\Models\Email;
use App\Models\Phone;

interface RepositoryUser
{
    public function doLogin(Email $email, string $password): array;
    public function createUser(array $userInfo): mixed;
}
