<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private RepositoryUser $repositoryUser;

    public function __construct(RepositoryUser $repositoryUser)
    {
        $this->middleware('auth:api', [
            'except' => ['login', 'unauthorized']
        ]);

        $this->repositoryUser = $repositoryUser;
    }

    public function login(Resquet $request): array
    {
        $email = new Email($requent->input('email'));
        $password = $request->input('password');

        return $this->repositoryUser->doLogin($email, $password);      
    }

    public function refresh(): array
    {   
        $response = [];
        
        $token = auth()->refresh();
        $response['token'] = $token;

        return $response;
    }

    public function logout(): array
    {   
        auth()->logout();
        return ['error' => ''];
    }

    public function unauthorized()
    {
        return response()->json([
            'error' => 'Acesso não autorizado!'
        ], 401);
    }
}
