<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\User\RepositoryUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{   

    private RepositoryUser $repositoryUser;

    public function __construct(RepositoryUser $repositoryUser)
    {
        $this->middleware('auth:api', [
            'except' => ['create', 'login']
        ]);

        $this->repositoryUser = $repositoryUser;
    }

    public function create(Resquest $request): mixed  
    {
        $userInfo = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'cellphone' => $request->input('cellphone'),
        ];

        $this->repositoryUser->createUser($userInfo);
    }
}
