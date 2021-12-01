<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Articles\Article;

class ArticlesController extends ParentController
{
    public function view(int $articleId) {
        $article = Article::getById($articleId);
        $reflector = new \ReflectionObject($article);
        $properties = $reflector->getProperties();
        $propertiesNames = [];
        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName();
        }
        var_dump($propertiesNames);
        return;
        if ($article === null) {
            $this->view->renderHtml('/../errors/404.php', [], 404);
            return;
        }
        $this->view->renderHtml('view.php',  ['article' => $article]);
    }
}