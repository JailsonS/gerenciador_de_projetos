<?php
namespace App\Models\User;

use App\Models\Email;
use App\Models\Phone;

interface RepositoryUser
{
    public function doLogin(Email $email, string $password): void;
    public function createUser(string $name, Email $email, Phone $phone): void;
}
