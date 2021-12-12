<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;

class MainController extends ParentController
{
    public function main()
    {
        $articles = [
            [
                'name' => 'Название статьи 1', 'text' => 'Текст статьи 1'
            ],
            [
                'name' => 'Название статьи 2', 'text' => 'Текст статьи 2'
            ]
        ];
        $this->view->renderHtml('main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('hello.php', ['name' => $name]);
    }

    public function sayBye(string $name)
    {
        $this->view->renderHtml('bye.php', ['name' => $name]);
    }
}