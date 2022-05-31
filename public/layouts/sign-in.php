<div class="modal sign-in">
    <div class="modal__content sign-in__modal">
        <span class="modal__close sign-in__close">&times;</span>
        <div class="sign-in__content">
            <div class="title">Вход</div>
            <form action="#" class="sign-in__form">
                <input type="text" name="login" placeholder="Логин" class="input sign-in__form__login" required
                       minlength="5" maxlength="20" pattern="^[А-Яа-яЁё][А-Яа-яЁё\s-]{3,18}[А-Яа-яЁё]$">
                <input type="password" name="password" placeholder="Пароль" class="input sign-in__form__password"
                       required
                       minlength="6" maxlength="18" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,18}$">
                <button type="submit" class="btn sign-in__btn">Войти</button>
                <button type="button" class="btn form__sign-up__btn">Регистрация</button>
            </form>
        </div>
    </div>
</div>
