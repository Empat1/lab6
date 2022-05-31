<?php
    $screenshot = $params['screenshot'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Blackshot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php require_once '../public/layouts/sign-in.php'; ?>

<?php require_once '../public/layouts/sign-up.php'; ?>

<div class="container">
    <?php require_once '../public/layouts/header.php'; ?>

    <main class="content">

        <div class="card-details">
            <img class="card__photo" src=<?= $screenshot['url'] ?> alt="Нет фото"/>
            <div class="card-details__info">
                <span class="card-details__name"> <?= $screenshot['name'] ?></span>
                <span class="card-details__data-added"><?= $screenshot['date_added'] ?></span>
            </div>
        </div>

        <a href="/">
            <button class="btn">Назад</button>
        </a>
    </main>

    <?php require_once '../public/layouts/footer.php'; ?>
</div>

<script src="js/main_script.js"></script>
</body>
</html>