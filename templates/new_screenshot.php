<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Add screenshot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/add_screen.css">
</head>
<body>

<?php require_once '../public/layouts/sign-in.php'; ?>

<?php require_once '../public/layouts/sign-up.php'; ?>

<div class="container">
    <?php require_once '../public/layouts/header.php'; ?>

    <main class="content">
    <?php if (isset($_SESSION['userLogin'])): ?>
        <form class="screen-form" enctype="multipart/form-data" method="POST">
            <label class="screen-form__label" for="newScreenName">Название скриншота</label>
            <input class="screen-form__input" id="newScreenName" type="text" name="name" required>

            <label class="screen-form__label" for="newScreenImg">Скриншот</label>
            <p class="screen-form__text">Картинка .jpeg размером не более 3 МБ</p>
            <input class="screen-form__file" id="newScreenImg" type="file" name="screenshot" accept=".jpg, .jpeg" onchange="validateFile()" required>

            <input type="submit" class="screen-form__submit btn" value="Добавить новый скриншот">
        </form>

        <div class="screen-form__errors"></div>
    <?php else: ?>
        <p class="not-logged">Войдите в свой аккаунт, чтобы добавлять скриншоты!</p>
<?php endif; ?>
    </main>


    <?php require_once '../public/layouts/footer.php'; ?>
</div>

<script src="/js/main_script.js"></script>
<script src="/js/new_screenshot.js"></script>
</body>
</html>
