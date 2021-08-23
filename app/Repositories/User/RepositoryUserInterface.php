<?php
namespace App\Repositories\User;

use App\Models\Email;
use App\Models\Phone;

interface RepositoryUserInterface
{
    public function login(Email $email, string $password): array;
    public function create(array $attributes): array;
    public function validate(array $attributes);
}
