<?php
namespace App\Repositories\Auth;

use App\Models\Email;
use App\Models\User\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Elloquent\RepositoryBase as RepositoryBaseElloquent;

class RepositoryAuth extends RepositoryBaseElloquent implements RepositoryAuthInterface
{
    /**
     * @param Model $model in RepositoryBase
     */
    public function __construct(User $model) 
    {
        parent::__construct($model);
    }

    public function login(Email $email, string $password): array
    {
        $response = ['error' => ''];

        $inputData = [
            'email' => $email,
            'password' => $password
        ];

        if($this->validate($inputData)->fails()) {
            $erros = $validation->errors()->all();
            $response['error'] = implode(',', $erros);
            return $response;
        }

        $token = auth()->attempt($inputData);

        if(!$token) {
            $response['error'] = Lang::get('auth.failed');
            return $response;
        }

        $user = auth()->user();
        $response['data'] = $user;
        $response['token'] = $token;

        return $response;
    }

    /**
     * @param $attributes assoc array
     */
    public function validate(array $attributes) 
    {
        return Validator::make($attributes, [
            'email' => 'required|email|max:150',
            'password' => 'required|string'
        ]);
    }
}