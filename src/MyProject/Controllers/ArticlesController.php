<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Articles\Article;

class ArticlesController extends ParentController
{
    public function view(int $articleId) {
        $article = Article::getById($articleId);
        if ($article === null) {
            $this->view->renderHtml('/../errors/404.php', [], 404);
            return;
        }
        $this->view->renderHtml('view.php',  ['article' => $article]);
    }
}