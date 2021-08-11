<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:');
    }

    public function create(Resquest $request): array  
    {

        $response = ['error' => ''];

        $validation = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:150|email',
            'name' => 'required|string|max:150'
        ]);

        if($validation->fails()) {
            $response['error'] = 'Formato de dados inválidos!';
            return $response;
        }

        $hash = password_hash($request->input('password'), PASSWORD_DEFAULT);

        $newUser = new User();
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = $hash;
        $newUser->save();
    }
}
