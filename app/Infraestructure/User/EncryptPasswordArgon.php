<?php
namespace App\Infraestructure\User;

use App\Models\User\EncryptPassword;

class EncryptPasswordArgon implements EncryptPassword
{
    public static function make(string $password): string 
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
    public static function check(string $passwordText, string $passwordEcrypted): bool
    {
        return password_verify($passwordText, $passwordEcrypted);
    }
}