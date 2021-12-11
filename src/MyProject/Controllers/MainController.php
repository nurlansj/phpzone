<?php
namespace MyProject\Controllers;

class MainController
{
    public function main()
    {
        include __DIR__ . '/../Templates/main/main.php';
    }

    public function sayHello(string $name)
    {
        
        echo 'Привет, ' . $name;
    }

    public function sayBye(string $name)
    {
        echo 'Пока, ' . $name;
    }
}