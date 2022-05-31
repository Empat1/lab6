let scrollBtn = document.querySelector(".more_cards");
scrollBtn.addEventListener('click', load_more);

function load_more() {
    scrollBtn = document.querySelector(".more_cards");

    let id = 0
    let cards = document.getElementsByClassName("card");

    if (cards) {
        cards = cards[cards.length - 1];
        if (cards) {
            id = cards.getAttribute('data-id');
        }
    }

    let url = '/cards/?id=' + id;
    let request = new XMLHttpRequest();
    request.open("GET", url);

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText.length !== 0) {
                scrollBtn.parentNode.removeChild(scrollBtn);
                document.getElementsByClassName("content")[0].innerHTML += this.responseText;
            }
        }
    }

    request.send();
}

