<?php
namespace App\Repositories\Elloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryElloquentInterface
{
    public function create(array $attributes): Model;
    public function find($id): ?Model;
}