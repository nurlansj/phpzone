<?php
namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use Vendor\Controllers\ParentController;
use Vendor\Services\Db;

class MainController extends ParentController
{   
    private $db;
    public function __construct() {
        parent::__construct();
        $this->db = new Db();
    }
    public function main()
    {
        $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        // var_dump($articles); return;
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