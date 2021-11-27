<?php include __DIR__ . '/../header.php' ?>
    <?php foreach ($articles as $article): ?>
        <h1><?= $article['name'] ?></h1>
        <h2><?= $article['text'] ?></h2>
        <hr>
    <?php endforeach; ?>
<?php include __DIR__ . '/../footer.php' ?>