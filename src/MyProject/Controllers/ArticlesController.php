<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Exceptions\NotFoundException;

class ArticlesController extends ParentController
{
    public function view(int $articleId) {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundException;
        }

        $this->view->renderHtml('view.php', ['article' => $article]);
    }
    public function edit(int $articleId): void {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundException;
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }
    public function add(): void {
        $author = User::getById(1);
        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');
        $article->save();

        // var_dump($article);
    }
    public function delete($articleId): void {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundException;
        }
        $article->delete();
        var_dump($article);
    }
}