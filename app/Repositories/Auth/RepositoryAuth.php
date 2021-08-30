<?php
namespace App\Repositories\Auth;

use App\Models\Email;
use App\Models\User\User;
use Illuminate\Support\Facades\Lang;
use App\Repositories\Elloquent\RepositoryBase as RepositoryBaseElloquent;

class RepositoryAuth extends RepositoryBaseElloquent implements RepositoryAuthInterface
{
    protected $model = User::class;

    public function login(Email $email, string $password): array
    {
        $response = ['error' => ''];

        $inputData = [
            'email' => $email,
            'password' => $password
        ];

        if($this->validate($inputData)->fails()) {
            $response['error'] = Lang::get('auth.incorrect_format');
            return $response;
        }

        $token = auth()->attempt($inputData);

        if(!$token) {
            $response['error'] = Lang::get('auth.failed');
            return $response;
        }

        $user = auth()->user();
        $response['data'] = $user;

        return $response;
    }

    /**
     * @param $attributes assoc array
     */
    public function validate(array $attributes): bool 
    {
        return Validator::make($attributes, [
            'email' => 'required|email|max:150',
            'password' => 'required|string'
        ]);
    }
}