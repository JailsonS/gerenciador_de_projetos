<?php
namespace App\Models\User;

use App\Models\Email;
use App\Models\Phone;
use App\Models\User\EncryptPassword;

interface RepositoryUser
{
    public function doLogin(Email $email, string $password, EncryptPassword $encryptPassword): void;
    public function createUser(string $name, Email $email, Phone $phone): void;
}
