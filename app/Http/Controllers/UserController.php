<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\RepositoryUserInterface;

class UserController extends Controller
{   
    private RepositoryUserInterface $repositoryUser;
    private $loggedUser;

    public function __construct(RepositoryUserInterface $repositoryUser)
    {
        $this->middleware('auth:api', [
            'except' => ['create']
        ]);

        $this->repositoryUser = $repositoryUser;
        $this->loggedUser = auth()->user();
    }

    public function create(Request $request): array  
    {
        $userInfo = [
            'id_categories' => $request->input('category'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirm' => $request->input('password_confirm'),
            'phone' => $request->input('phone'),
            'cellphone' => $request->input('cellphone'),
        ];

        return $this->repositoryUser->createUser($userInfo);
    }

    public function update(Request $request): array 
    {
        $userInfo = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'cellphone' => $request->input('cellphone'),
        ];

        return $this->repositoryUser->updateUser($userInfo, $this->loggedUser->id);
    }

    public function read(): array  
    {
        $response = ['error' => ''];

        $response['data'] = $this->loggedUser;

        return $response;
    }

    public function list(): array  
    {
        return $this->repositoryUser->list();
    }

    public function one($id): array  
    {
        return $this->repositoryUser->findById($id); 
    }

    /**
     * @param User $id
     */
    public function updateOneUser(Request $request, $id): array 
    {
        $userInfo = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'cellphone' => $request->input('cellphone'),
        ];

        return $this->repositoryUser->updateUser($userInfo, $id);
    }

    /**
     * @param User $id
     */
    public function deleteOneUser($id): array 
    {
        return $this->repositoryUser->delete($id);
    }
}
