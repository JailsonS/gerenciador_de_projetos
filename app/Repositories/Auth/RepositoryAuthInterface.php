<?php 
namespace App\Repositories\Auth;

interface RepositoryAuthInterface
{   
    public function login(Email $email, string $password): array;
    public function validate(array $attributes);
}