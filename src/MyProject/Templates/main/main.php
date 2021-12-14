<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($articles as $article): ?>
    <h3><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h3>
    <p><?= $article->getText() ?></p>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>