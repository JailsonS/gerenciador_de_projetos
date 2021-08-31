<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\RepositoryAuthInterface;

class AuthController extends Controller
{
    private RepositoryAuthInterface $repositoryAuth;

    public function __construct(RepositoryAuthInterface $repositoryAuth)
    {
        $this->middleware('auth:api', [
            'except' => ['login', 'unauthorized']
        ]);

        $this->repositoryAuth = $repositoryAuth;
    }

    public function login(Request $request): array
    {
        $email = new Email($request->input('email'));
        $password = $request->input('password');

        $response = $this->repositoryAuth->login($email, $password);    

        return $response;
    }

    public function refresh(): array
    {   
        $response = ['error' => ''];
        
        $token = auth()->refresh();
        $userData = auth()->user();

        $response['data'] = $userData;
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
