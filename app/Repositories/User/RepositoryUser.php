<?php
namespace App\Repositories\User;

use App\Models\Email;
use App\Models\User\User;
use Illuminate\Support\Facades\Lang;
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

        $validation = $this->validate($attributes);

        if($validation->fails()) {
            $response['error'] = Lang::get('validation.mimetypes');
            return $response;
        }

        $user = $this->model->create($attributes);

        $response['data'] = $user;
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
    public function validate(array $attributes): bool
    {
        return Validator::make($attributes, [
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);
    }
}