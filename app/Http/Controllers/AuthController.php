<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['login', 'unauthorized']
        ]);
    }

    public function login(Resquet $request)
    {   
        $response = ['error' => ''];

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
