<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    public function login(Resquet $request)
    {   

    }

    public function refresh(): array
    {   
        
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
