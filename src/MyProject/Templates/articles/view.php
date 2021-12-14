<?php include __DIR__ . '/../header.php'; ?>
    <h3><?= $article->getName() ?></h3>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php include __DIR__ . '/../footer.php'; ?>