<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use App\Models\User\RepositoryUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Infraestructure\User\RepositoryUserI;
use Illuminate\Http\Request;

class UserController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['create', 'login']
        ]);
        
        $this->repositoryUser = new RepositoryUserI();
    }

    public function create(Request $request): array  
    {

        $repositoryUser = new RepositoryUserI();

        $userInfo = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone' => $request->input('phone'),
            'cellphone' => $request->input('cellphone'),
        ];

        

        return $repositoryUser->createUser($userInfo);


    }
}
