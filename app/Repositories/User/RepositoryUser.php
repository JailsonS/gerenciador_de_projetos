<?php
namespace App\Repositories\User;

use App\Models\Email;
use App\Models\User\User;
use App\Models\User\Password;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $attributes['password'] = new Password($attributes['password']);

        $user = $this->model->create($attributes);
        $response['message'] = Lang::get('end.success', ['object' => 'Usuário']);

        return $response;
    }

    /**
     * @param User $id
     */
    public function updateUser(array $attributes, int $id): array
    {
        $response = ['error' => ''];

        $validation = $this->validateOnUpdate($attributes, $id);

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
        
        $response['message'] = Lang::get('end.success_update', ['object' => 'Usuário']);

        return $response;
    }

    public function list(): array  
    {
        $response = ['error' => ''];

        $response['data'] = $this->model::all();

        return $response;
    }

    public function findById(int $id): array
    {
        $response = ['error' => ''];

        $response['data'] = $this->model::find($id);

        return $response;
    }

    public function delete(int $id): array 
    {
        $response = ['error' => ''];

        $user = $this->model->find($id);

        if(!$user) {
            $response['msg'] = Lang::get('end.not_found');;
            return $response;
        }

        $user->delete();

        return $response;
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
    public function validateOnUpdate(array $attributes, $id)
    {
        return Validator::make($attributes, [
            'name' => 'required|string|max:150',
            'email' => ['email', 'required', Rule::unique('users')->ignore($id)],
            'phone' => ['string', Rule::unique('users')->ignore($id)],
            'cellphone' => ['string', Rule::unique('users')->ignore($id)],
        ]);
    }
}