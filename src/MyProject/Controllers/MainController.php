<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Articles\Article;

class MainController extends ParentController
{
    public function main() {
        $articles = Article::findAll();
        $this->view->renderHtml('view.php',  ['articles' => $articles]);
    }

    public function sayHello(string $name) {
        $this->view->renderHtml('sayHello.php',  ['name' => $name]);
    }

    public function sayBye(string $name) {
        $this->view->renderHtml('sayBye.php',  ['name' => $name]);
    }
}