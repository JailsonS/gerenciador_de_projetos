<?php
namespace App\Repositories\User;

use App\Models\Email;
use App\Models\User\User;
use App\Repositories\Elloquent\RepositoryBase;

class RepositoryUser extends RepositoryBase implements RepositoryUserInterface
{
    protected $model = User::class;

    public function login(Email $email, string $password): array
    {
        
    }
}