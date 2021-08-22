<?php
namespace App\Infraestructure\User;

use App\Models\Email;
use App\Models\User\RepositoryUser;
use App\Infraestructure\User\EncryptPasswordArgon;

class RepositoryStudentOrm implements RepositoryUser
{
    public function doLogin(Email $email, string $password, EncryptPasswordArgon $encryptPassword): array
    {
        $response = ['error' => ''];

        

        return $response;
    }
}