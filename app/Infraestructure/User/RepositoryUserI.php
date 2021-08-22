<?php
namespace App\Infraestructure\User;

use App\Models\Email;
use App\Models\User\RepositoryUser;

class RepositoryUserI implements RepositoryUser
{
    public function doLogin(Email $email, string $password): array
    {
        $response = ['error' => ''];

        $token = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$token) {
            $response['error'] = Lang::get('auth.failed');
            return $response;
        }

        $userData = auth()->user();

        $response['data'] = $userData;
        $response['token'] = $token;

        return $response;
    }

    public function createUser()
    {
        
    }
}