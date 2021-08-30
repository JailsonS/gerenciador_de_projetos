<?php
namespace App\Repositories\User;

use App\Models\Email;

interface RepositoryUserInterface
{
    public function findById(int $id): array;
    public function createUser(array $attributes): array;
}
