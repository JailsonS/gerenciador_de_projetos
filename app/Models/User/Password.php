<?php  
namespace App\Models\User;

class Password 
{
    private string $password;

    public function __construct(string $password)
    {
        $this->verify($password);
        $this->password = password_hash($password, PASSWORD_ARGON2ID);
    }

    public function verify($password)
    {
        if(\preg_match("/\b([a-zA-Z]*[0-9]+[a-zA-Z]*){2,}\b/", $password) !== 1) {
            throw new \InvalidArgumentException(Lang::get('auth.pass_incorrect_format'));
        }

        if(\preg_match("/\b(\w+){5,}\b/", $password) !== 1) {
            throw new \InvalidArgumentException(Lang::get('auth.pass_incorrect_format'));
        }
    }

    public function __toString(): string
    {
        return $this->password;
    }
}