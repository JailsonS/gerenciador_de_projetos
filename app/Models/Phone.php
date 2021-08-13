<?php   

namespace App\Models;

class Phone
{
    private string $ddd;
    private string $number;


    public function __construct(string $ddd, string $number)
    {
        $this->setDdd($ddd);
        $this->setNumber($number);
    }

    private function setDdd(string $ddd): void
    {
        if(\preg_match('/\d{2}/', $ddd) !== 1) {
            throw new \InvalidArgumentException('DDD inválido!');
        }
        $this->ddd = $ddd;
    }

    public function setNumber(string $number): void
    {
        if(\preg_match('/\d{8,9}/', $number) !== 1) {
            throw new \InvalidArgumentException('Formato de número inválido!');
        }
        $this->number = $number;
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->number}";
    }
}