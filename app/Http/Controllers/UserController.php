<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\RepositoryUserInterface;

class UserController extends Controller
{   
    private RepositoryUserInterface $repositoryUser;

    public function __construct(RepositoryUserInterface $repositoryUser)
    {
        $this->middleware('auth:api', [
            'except' => ['create', 'login']
        ]);

        $this->repositoryUser = $repositoryUser;
    }

    public function create(Request $request): array  
    {
        $userInfo = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirm' => $request->input('password_confirm'),
            'phone' => $request->input('phone'),
            'cellphone' => $request->input('cellphone'),
        ];

        return $this->repositoryUser->createUser($userInfo);
    }
}
