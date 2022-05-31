<header class="header">
    <div class="header__title">
        <a href="#">Blackshot</a>
    </div>

    <div class="header__buttons">
        <?php if (!isset($_SESSION['userLogin'])): ?>
            <button class="header__sign-in-btn btn">Войти</button>
            <button class="header__sign-up-btn btn">Зарегистрироваться</button>
        <?php else: ?>
            <p class="header__login">Привет, <?= $_SESSION['userLogin'] ?></p>
            <a class="header__add_screen-btn btn" href="/new_screenshot/">Добавить скриншот</a>
            <a class="header__logout-btn btn" href="/logout/">Выйти</a>
        <?php endif; ?>
    </div>


</header>
