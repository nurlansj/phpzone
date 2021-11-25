<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use Vendor\Services\Db;
class ArticlesController extends ParentController
{
    private $db;
    public function __construct() {
        parent::__construct();
        $this->db = new Db();
    }
    public function view(int $articleId) {
        $result = $this->db->query('SELECT * FROM `articles` WHERE id = :id;', [':id' => $articleId]);
        if ($result === []) {
            $this->view->renderHtml('/../errors/404.php', [], 404);
            return;
        }
        // var_dump($result); die();
        $this->view->renderHtml('view.php', ['article' => $result[0]]);
    }
}