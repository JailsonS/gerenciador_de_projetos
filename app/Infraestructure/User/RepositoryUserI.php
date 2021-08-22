<?php
namespace App\Infraestructure\User;

use App\Models\Email;
use App\Models\User\User;
use App\Models\User\RepositoryUser;
use Illuminate\Support\Facades\Validator;

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

    public function createUser(array $userInfo): mixed
    {
        $response = ['error' => ''];

        $validation = Validator::make($userInfo, [
            'email' => 'required|unique:users|max:150|email',
            'name' => 'required|string|max:150'
        ]);

        if($validation->fails()) {
            $response['error'] = Lang::get('validation.email', ['attribute' => 'campo e-mail']);
            return $response;
        }

        $hash = password_hash($request->input('password'), PASSWORD_ARGON2ID);
        $email = new Email($request->input('email'));

        $newUser = new User();
        $newUser->name = $request->input('name');
        $newUser->email = $email;
        $newUser->password = $hash;
        $newUser->save();
    }
}