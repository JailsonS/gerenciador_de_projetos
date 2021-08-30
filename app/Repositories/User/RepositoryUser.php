<?php
namespace App\Repositories\User;

use App\Models\Email;
use App\Models\User\User;
use App\Repositories\Elloquent\RepositoryBase as RepositoryBaseElloquent;

class RepositoryUser extends RepositoryBaseElloquent implements RepositoryUserInterface
{
    protected $model = User::class;

    public function createUser(array $attributes): array
    {
        
    }
}