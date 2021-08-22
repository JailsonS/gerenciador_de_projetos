<?php
namespace App\Models\User;

use Illuminate\Support\Facades\Hash;

interface EncryptPassword
{
    public static function make(string $password): string;
    public static function check(string $passwordText, string $passwordEcrypted): mixed;
}