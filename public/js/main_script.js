document.addEventListener("DOMContentLoaded", function () {

    const signInModal = document.querySelector(".sign-in");
    const signInButton = document.querySelector(".header__sign-in-btn");
    const closeSignInFormBtn = document.querySelector(".sign-in__close");

    signInButton.onclick = function () {
        signInModal.classList.add('modal_active');
    };
    closeSignInFormBtn.onclick = function () {
        signInModal.classList.remove('modal_active');
    };

    const signUpModal = document.querySelector(".sign-up");
    const signUpButton = document.querySelector(".header__sign-up-btn");
    const closeSignUpFormBtn = document.querySelector(".sign-up__close");

    signUpButton.onclick = function () {
        signUpModal.classList.add('modal_active');
    };
    closeSignUpFormBtn.onclick = function () {
        signUpModal.classList.remove('modal_active');
    };

    const formSignUpButton = document.querySelector(".form__sign-up__btn");

    formSignUpButton.onclick = function () {
        signInModal.classList.remove('modal_active');
        signUpModal.classList.add('modal_active');
    }

    const formSignInButton = document.querySelector(".form__sign-in__btn");

    formSignInButton.onclick = function () {
        signUpModal.classList.remove('modal_active');
        signInModal.classList.add('modal_active');
    }

    const loginInputs = document.getElementsByName("login");

    for (var i = 0; i < loginInputs.length; i++) {
        let loginInput = loginInputs[i];

        loginInput.addEventListener("input", function (e) {
            var validity = loginInput.validity;
            if (validity.patternMismatch) {
                loginInput.setCustomValidity("В логине допустимы только русские буквы, пробелы и дефисы");
            } else if (validity.tooLong) {
                var max = loginInput.getAttribute("maxlength");
                loginInput.setCustomValidity("Максимальное количество символов " + max);
            } else if (validity.tooShort) {
                var min = loginInput.getAttribute("minlength");
                loginInput.setCustomValidity("Минимальное количество символов " + min);
            } else {
                loginInput.setCustomValidity("");
            }
        })
    }

    const passwordInputs = document.getElementsByName("password");

    for (i = 0; i < passwordInputs.length; i++) {
        let passwordInput = passwordInputs[i];

        passwordInput.addEventListener("input", function (e) {
            var validity = passwordInput.validity;
            var min = passwordInput.getAttribute("minlength");
            if (validity.patternMismatch) {
                passwordInput.setCustomValidity("В пароле должна быть хотя бы одна буква латинского алфавита, цифра," +
                    " минимальная длина пароля " + min + " символов");
            } else if (validity.tooLong) {
                var max = passwordInput.getAttribute("maxlength");
                passwordInput.setCustomValidity("Максимальное количество символов " + max);
            } else if (validity.tooShort) {
                passwordInput.setCustomValidity("Минимальное количество символов " + min);
            } else {
                passwordInput.setCustomValidity("");
            }
        })
    }

    const repeatPassword = document.querySelector(".repeat-password");

    repeatPassword.addEventListener("input", function (e) {
        let passwordValue = document.querySelector(".password").value;

        if (repeatPassword.value !== passwordValue) {
            repeatPassword.setCustomValidity("Пароли должны совпадать");
        } else {
            repeatPassword.setCustomValidity("");
        }
    })

    const emailInput = document.querySelector(".email");

    emailInput.addEventListener("input", function (e) {
        var validity = emailInput.validity;
        if (validity.patternMismatch) {
            emailInput.setCustomValidity("Введена некорректная почта");
        } else {
            emailInput.setCustomValidity("");
        }
    })

    const phoneInput = document.querySelector(".phone");

    phoneInput.addEventListener("input", function (e) {
        var validity = phoneInput.validity;
        if (validity.patternMismatch) {
            phoneInput.setCustomValidity("Введён некорректный телефон");
        } else {
            phoneInput.setCustomValidity("");
        }
    })

    const signInForm = document.querySelector(".sign-in__form");

    signInForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let authForm = new FormData();

        let loginInput = document.querySelector(".sign-in__form__login");
        let passwordInput = document.querySelector(".sign-in__form__password");

        authForm.append('login', loginInput.value);
        authForm.append('password', passwordInput.value);

        fetch('/auth/', {
            method: 'POST',
            body: authForm
        }).then(response => response.json())
            .then(result => {
                if (result.errors) {
                    alert(result.errors)
                } else {
                    location.href = location.href;
                }
            }).catch(error => console.log(error));
    })

    const signUpForm = document.querySelector(".sign-up__form");

    signUpForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let registerForm = new FormData();
        let loginInput = document.querySelector(".sign-up__form__login");
        let passwordInput = document.querySelector(".sign-up__form__password");
        let emailInput = document.querySelector(".email");
        let phoneInput = document.querySelector(".phone");

        registerForm.append('login', loginInput.value);
        registerForm.append('password', passwordInput.value);
        registerForm.append('email', emailInput.value);
        registerForm.append('phone', phoneInput.value);

        fetch('/register/', {
                method: 'POST',
                body: registerForm
            }
        )
            .then(response => response.json())
            .then(result => {
                console.log(result);
                if (result.errors) {
                    alert(result.errors);
                } else {
                    location.href = location.href;
                }
            })
            .catch(error => console.log(error));
    });
});
