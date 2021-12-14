<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use Vendor\Services\Db;
use MyProject\Models\Articles\Article;

class MainController extends ParentController
{
    public function main()
    {
        $db = Db::getInstance();
        $articles = $db->query('select * from articles', [], Article::class);
        // var_dump($articles);
        // return;
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