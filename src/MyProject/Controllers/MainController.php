<?php
namespace MyProject\Controllers;
use Vendor\Controllers\ParentController;
use MyProject\Services\Db;

class MainController extends ParentController
{   
    private $db;
    public function __construct() {
        parent::__construct();
        $this->db = new Db();
    }
    public function main()
    {
        $articles = $this->db->query('SELECT * FROM `articles`;');
        var_dump($articles);
        // $articles = [
        //     ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
        //     ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
        // ];
        // $this->view->renderHtml('main.php', ['articles' => $articles]);
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