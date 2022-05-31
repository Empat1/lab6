<div class="modal sign-up">
    <div class="modal__content sign-up__modal">
        <span class="modal__close sign-up__close">&times;</span>
        <div class="sign-up__content">
            <div class="title">Регистрация</div>
            <form action="#" class="sign-up__form">
                <input type="text" name="login" placeholder="Логин" class="input sign-up__form__login" required
                       minlength="5" maxlength="20" pattern="^[А-Яа-яЁё][А-Яа-яЁё\s-]{3,18}[А-Яа-яЁё]$">
                <input type="password" name="password" placeholder="Пароль"
                       class="input password sign-up__form__password" required
                       minlength="6" maxlength="18" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,18}$">
                <input type="password" placeholder="Повторите пароль" class="input repeat-password" required
                       minlength="6" maxlength="18" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,18}$">
                <input type="email" placeholder="Email" class="input email" required
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                <input type="tel" placeholder="Телефон" class="input phone" required
                       minlength="11" maxlength="11" pattern="[0-9]{11}">

                <div class="checkbox__wrapper">
                    <input type="checkbox" class="input" required>
                    <span>Согласие на обработку</span>
                </div>
                <button type="submit" class="btn sign-up__btn">Зарегистрироваться</button>
                <button type="button" class="btn form__sign-in__btn">Вход</button>
            </form>
        </div>
    </div>
</div>
