<?php 
namespace App\Repositories\Auth;

use App\Models\Email;

interface RepositoryAuthInterface
{   
    public function login(Email $email, string $password): array;
    public function validate(array $attributes);
}