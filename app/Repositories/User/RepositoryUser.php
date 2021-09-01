<?php
namespace App\Repositories\User;

use App\Models\Email;
use App\Models\User\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Elloquent\RepositoryBase as RepositoryBaseElloquent;

class RepositoryUser extends RepositoryBaseElloquent implements RepositoryUserInterface
{
    /**
    * UserRepository constructor.
    *
    * @param User $model
    */
    public function __construct(User $model) 
    {
        parent::__construct($model);
    }

    public function createUser(array $attributes): array
    {
        $response = ['error' => ''];

        $validation = $this->validateOnCreate($attributes);

        if($validation->fails()) {
            $response['error'] = $validation->messages();
            return $response;
        }

        unset($attributes['password_confirm']);
        $attributes['password'] = password_hash($attributes['password'], PASSWORD_ARGON2ID);

        $user = $this->model->create($attributes);
        
        $token = auth()->attempt([
            'email' => $attributes['email'],
            'password' => $attributes['password']
        ]);

        if(!$token) {
            $response['error'] = Lang::get('auth.failed');
            return $response;
        }

        $response['data'] = $user;
        $response['token'] = $token;
        $response['message'] = Lang::get('end.success', ['object' => 'Usuário']);

        return $response;
    }

    /**
     * @param User $id
     */
    public function updateUser(array $attributes, int $id): array
    {
        $response = ['error' => ''];

        $validation = $this->validateOnUpdate($attributes);

        if($validation->fails()) {
            $response['error'] = $validation->messages();
            return $response;
        }

        $user = $this->model::find($id);
        
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->phone = $attributes['phone'];
        $user->cellphone = $attributes['cellphone'];
        $user->save();
        
        $response['message'] = Lang::get('end.success', ['object' => 'Usuário']);

        return $response;
    }

    /**
     * @return User[]
     */
    public function findById(int $id): array
    {
        
    }

    /**
     * @param assoc array
     */
    public function validateOnCreate(array $attributes)
    {
        return Validator::make($attributes, [
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|same:password_confirm',
            'password_confirm' => 'required|string|same:password',
        ]);
    }

    /**
     * @param assoc array
     */
    public function validateOnUpdate(array $attributes)
    {
        return Validator::make($attributes, [
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users',
            'phone' => 'unique:users|string',
            'cellphone' => 'unique:users|string',
        ]);
    }
}