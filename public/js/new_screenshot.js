function validateFile() {
    let screenshotInput = document.getElementById("newScreenImg");
    let screenshot = screenshotInput.files[0];

    var validity = screenshotInput.validity;

    let screenFormErrors = document.querySelector(".screen-form__errors");

    if (validity.typeMismatch) {
        screenFormErrors.innerHTML = "<p>" + "Ошибка типа!" + "</p> <br/>";
        screenshotInput.value = "";
    } else if (screenshot.type !== 'image/jpeg') {
        screenFormErrors.innerHTML = "<p>" +"Неподерживаемый формат!" + "</p> <br/>";
        screenshotInput.value = "";
    } else {
        screenFormErrors.innerHTML = "";
    }
}

const newScreenshotForm = document.querySelector('.screen-form');

newScreenshotForm.addEventListener("submit", function (e) {
    e.preventDefault();

    let screenshotInput = document.getElementById("newScreenImg");
    let screenshot = screenshotInput.files[0];

    let newScreenshot = new FormData();

    newScreenshot.append('name', newScreenshotForm.name.value);
    newScreenshot.append('screenshot', screenshot);

    fetch('/save_screenshot/', {
            method: 'POST',
            body: newScreenshot
        }
    )
        .then(response => response.json())
        .then(result => {
            if (result.errors) {
                let screenFormErrors = document.querySelector(".screen-form__errors");
                screenFormErrors.innerHTML = "<p>" + result.errors + "</p> <br/>";
            } else {
                location.href = "/details/?uuid=" + result.uuid;
            }
        })
        .catch(error => console.log(error));
});
