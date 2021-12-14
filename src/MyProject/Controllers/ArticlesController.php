<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Articles\Article;

class ArticlesController extends ParentController
{
    public function view(int $articleId): void {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('/../errors/404.php', ['message' => 'Такой статьи не существует'], 404);
            return;
        }

        $this->view->renderHtml('view.php', ['article' => $article]);
    }
}