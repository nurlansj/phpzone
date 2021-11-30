<?php include __DIR__ . '/../header.php' ?>
    <?php foreach ($articles as $article): ?>
        <h3><?= $article->getAuthor()->getNickname() ?></h3>
        <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
        <h4><?= $article->getText() ?></h4>
        <hr>
    <?php endforeach; ?>
<?php include __DIR__ . '/../footer.php' ?>