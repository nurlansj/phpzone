<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;

class MainController extends ParentController
{
    // test-commit
    public function main()
    {
        $articles = [
            ['name' => 'Статья 1', 'text' => 'text text text text text'],
            ['name' => 'Статья 2', 'text' => 'text2 text2 text2 text2 text2']
        ];
        $this->view->renderHtml('view.php',  ['articles' => $articles]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('sayHello.php',  ['name' => $name]);
    }

    public function sayBye(string $name)
    {
        $this->view->renderHtml('sayBye.php',  ['name' => $name]);
    }
}